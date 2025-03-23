<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Monthly Invoice is Ready')
            ->greeting("Hello {$notifiable->name},")
            ->line('Your monthly invoice has been generated.')
            ->line("Invoice Number: {$this->invoice->invoice_number}")
            ->line("Amount: $" . number_format($this->invoice->amount, 2))
            ->line("Due Date: {$this->invoice->due_date->format('F j, Y')}")
            ->action('View Invoice', url("/dashboard/invoices/{$this->invoice->id}"))
            ->line('Thank you for your business!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'invoice_id' => $this->invoice->id,
            'invoice_number' => $this->invoice->invoice_number,
            'amount' => $this->invoice->amount,
            'due_date' => $this->invoice->due_date->format('Y-m-d'),
            'message' => 'Your monthly invoice has been generated.',
        ];
    }
}