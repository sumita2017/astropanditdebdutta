<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Razorpay\Api\Api;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paymentlinkcreate()
    {
        $api_key = "rzp_test_O4YgeKdsNw7aYN";
        $api_secret = "LD7sQm73jywJShqST0ciQSVo";
        $api = new Api($api_key, $api_secret);
        try {
            $api->paymentLink->create(array(
                'amount' => 500, 'currency' => 'INR', 'accept_partial' => true,
                'first_min_partial_amount' => 100, 'description' => 'For XYZ purpose', 'customer' => array(
                    'name' => 'Gaurav Kumar',
                    'email' => 'gaurav.kumar@example.com', 'contact' => '+919000090000'
                ),  'notify' => array('sms' => true, 'email' => true),
                'reminder_enable' => true, 'notes' => array('policy_name' => 'Jeevan Bima'), 'callback_url' => 'https://example-callback-url.com/',
                'callback_method' => 'get'
            ));
            
        } catch ($e) {
            return $e->getMessage();
            Session::put('error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
