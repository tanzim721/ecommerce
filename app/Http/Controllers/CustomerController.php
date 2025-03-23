<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index() {
        return view('admin.customer.index');
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'number' => 'required|numeric|digits_between:10,15',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Store the data
            $customer = Customer::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'address' => $request->address,
                'number' => $request->number
            ]);

            return response()->json(['message' => 'Customer added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save customer. Please try again.'], 500);
        }
    }


}
