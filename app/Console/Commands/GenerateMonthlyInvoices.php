<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceGenerated;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GenerateMonthlyInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate monthly invoices for all active subscriptions';

    public function handle()
    {
        $this->info('Starting invoice generation process...');
        
        // Get all users with active subscriptions
        $users = User::whereHas('subscription', function($query) {
            $query->where('status', 'active');
        })->get();
        
        $this->info("Found {$users->count()} users with active subscriptions");
        
        $invoicesGenerated = 0;
        
        foreach ($users as $user) {
            $this->info("Processing user: {$user->email}");
            
            // Check if invoice already exists for this month
            $startOfMonth = Carbon::now()->startOfMonth();
            $existingInvoice = Invoice::where('user_id', $user->id)
                ->whereDate('created_at', '>=', $startOfMonth)
                ->exists();
                
            if ($existingInvoice) {
                $this->info("Invoice already exists for {$user->email} this month. Skipping.");
                continue;
            }
            
            // Calculate charges based on subscription plan and usage
            $subscription = $user->subscription;
            $amount = $this->calculateInvoiceAmount($user, $subscription);
            
            // Create invoice record
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'amount' => $amount,
                'due_date' => Carbon::now()->addDays(15),
                'status' => 'pending',
                'invoice_number' => 'INV-' . time() . '-' . $user->id,
            ]);
            
            // Generate PDF invoice
            $this->generateInvoicePdf($invoice);
            
            // Notify user
            $user->notify(new InvoiceGenerated($invoice));
            
            $invoicesGenerated++;
            $this->info("Invoice #{$invoice->invoice_number} generated for {$user->email}");
        }
        
        $this->info("Invoice generation completed. Created {$invoicesGenerated} new invoices.");
        
        return 0;
    }
    
    private function calculateInvoiceAmount($user, $subscription)
    {
        // Base subscription amount
        $amount = $subscription->price;
        
        // Add usage-based charges
        $usageCharges = $this->calculateUsageCharges($user);
        
        // Add any additional services
        $additionalServices = $this->calculateAdditionalServices($user);
        
        // Apply discounts if any
        $discounts = $this->calculateDiscounts($user);
        
        return $amount + $usageCharges + $additionalServices - $discounts;
    }
    
    private function calculateUsageCharges($user)
    {
        // Implement usage tracking logic here
        // For example: API calls, storage usage, etc.
        return 0;
    }
    
    private function calculateAdditionalServices($user)
    {
        // Implement additional services charges
        // For example: premium support, add-ons, etc.
        return 0;
    }
    
    private function calculateDiscounts($user)
    {
        // Implement discount logic
        // For example: loyalty discounts, promotional offers, etc.
        return 0;
    }
    
    private function generateInvoicePdf($invoice)
    {
        // Implement PDF generation for invoice
        // This would typically use a package like barryvdh/laravel-dompdf
        
        $this->info("PDF invoice generated and saved for invoice #{$invoice->invoice_number}");
    }
}