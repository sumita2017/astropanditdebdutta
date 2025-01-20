<?php

namespace App\Http\Controllers;

use App\Models\phonepe;
use App\Models\Appointment;
use App\Models\User;
use App\Models\invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use PDF;

class PhonepeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function managepayment()
    {
        $paymentdetails = phonepe::first();
        //dd($paymentdetails);
        return view('admin.managepayment', ['page_name' => 'Manage Payment Details', 'navstatus' => "phonepepayment", 'paymentdetails' => $paymentdetails]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $phonepedata = phonepe::select('id')->first();
        //dd($phonepedata);
        if ($phonepedata != null) {

            $phonepe['paymentamount'] = $data['paymentamount'] * 100;
            $phonepe['marchecntkey'] = $data['marchecntkey'];
            $phonepe['apikey'] = $data['apikey'];
            $phonepe['apiindex'] = $data['apiindex'];
            $phonepe['hosturl'] = $data['hosturl'];

            $update = phonepe::where('id', $phonepedata->id)
                ->update($phonepe);

            if ($update) {
                session(['status' => "1", 'msg' => 'Payment details Updated successfully']);
            } else {
                session(['status' => "0", 'msg' => 'Payment details is not Updated']);
            }
        } else {
            $newphonepe = new phonepe;
            $newphonepe->paymentamount = $data['paymentamount'] * 100;
            $newphonepe->marchecntkey = $data['marchecntkey'];
            $newphonepe->apikey = $data['apikey'];
            $newphonepe->apiindex = $data['apiindex'];
            $newphonepe->hosturl = $data['hosturl'];

            //set session
            if ($newphonepe->save()) {
                session(['status' => "1", 'msg' => 'Payment details Updated successfully']);
            } else {
                session(['status' => "0", 'msg' => 'Payment details is not Updated']);
            }
        }
        return redirect()->back();
    }

    /**
     * phonepe page create.
     */
    public function phonePe($id)
    {
        $id = base64_decode($id);
        $phonepedata = phonepe::first();

        $users = User::leftJoin('appointments', 'users.id', '=', 'appointments.userId')->select('appointments.phoneNumber', 'users.name', 'users.id')->where('appointments.id', $id)->first();

        $username = preg_replace('/\s+/', '', $users->name);
        $merchantTransactionId = substr(strtoupper($username), 0, 4) . time();

        $data = array(
            'merchantId' => $phonepedata->marchecntkey,
            'merchantTransactionId' => 'AADD' . $merchantTransactionId,
            'merchantUserId' => 'AADD' . $users->id,
            'amount' => $phonepedata->paymentamount,
            'redirectUrl' => route('response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'),
            'mobileNumber' => $users->phoneNumber,
            'paymentInstrument' =>
                array(
                    'type' => 'PAY_PAGE',
                ),
        );

        $encode = base64_encode(json_encode($data));

        $saltKey = $phonepedata->apikey;
        $saltIndex = $phonepedata->apiindex;

        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;

        $url = $phonepedata->hosturl . 'pg/v1/pay';
        //dd($url);
        $response = Curl::to($url)
            ->withHeader('Content-Type:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withData(json_encode(['request' => $encode]))
            ->post();
        $rData = json_decode($response);

        //dd($rData);
        if ($rData->success == true) {
            // dd($rData);
            $updatedata['merchantTransactionId'] = $rData->data->merchantTransactionId;
            $updateappointment = Appointment::where('id', '=', $id)->update($updatedata);
            return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        } else {
            session(['status' => "0", 'msg' => 'Payment failed, Please try again']);
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     */
    public function response(Request $request)
    {
        $input = $request->all();
        //dd($input);
        if ($input["code"] == "PAYMENT_PENDING") {
            $userpaymentdetails['status'] = 0;
            $userpaymentdetails['msg'] = "Your payment is currently being processed. We’ll notify you once it’s completed. Thank you for your patience!";
            //return with error msg
            return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);
        } else if ($input["code"] == "PAYMENT_ERROR") {
            $userpaymentdetails['status'] = 0;
            $userpaymentdetails['msg'] = "Payment failed, Please try again";

            //return with error msg
            return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);

        } else {
            $merchantTransactionId = $input['transactionId'];
            $appointmentid = Appointment::where('merchantTransactionId', '=', $merchantTransactionId)->select('id')->first();

            $users = User::leftJoin('appointments', 'users.id', '=', 'appointments.userId')->where('appointments.id', $appointmentid->id)->first();
            if ($users->appointmentType == 'o') {
                $userpaymentdetails['appointmentType'] = "Online";
            } else {
                $userpaymentdetails['appointmentType'] = "Offline";
            }

            $userpaymentdetails['customername'] = $users->name;
            $userpaymentdetails['customeremail'] = $users->email;
            $userpaymentdetails['customerphonenumber'] = $users->phoneNumber;
            $userpaymentdetails['merchantTransactionId'] = $merchantTransactionId;

            $phonepedata = phonepe::first();
            $saltKey = $phonepedata->apikey;
            $saltIndex = $phonepedata->apiindex;

            $merchantId = $input['merchantId'];

            $providerReferenceId = $input['providerReferenceId'];

            $finalXHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;
            //dd($saltKey);
            $phonepedata = phonepe::first();
            $url = $phonepedata->hosturl . 'pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'];
            //dd($url);
            $response = Curl::to($url)
                ->withHeader('Content-Type:application/json')
                ->withHeader('accept:application/json')
                ->withHeader('X-VERIFY:' . $finalXHeader)
                ->withHeader('X-MERCHANT-ID:' . $input['merchantId'])
                ->get();

            $response = json_decode($response);
            $invoiceid = "INV" . substr(strtotime("now"), 6);
            $userpaymentdetails['invoiceId'] = $invoiceid;

            if ($response) {
                if ($response->success == true) {

                    $newInvoice = new invoice;
                    $responcedata = $response->data;
                    //dd($responcedata);
                    $newInvoice->invoiceId = $invoiceid;
                    $newInvoice->appointmentid = $appointmentid->id;
                    $newInvoice->merchantTransactionId = $responcedata->merchantTransactionId;
                    $newInvoice->transactionId = $responcedata->transactionId;
                    $newInvoice->providerReferenceId = $providerReferenceId;
                    $newInvoice->amount = $responcedata->amount / 100;
                    $newInvoice->status = $responcedata->state;
                    $newInvoice->responseCode = $responcedata->responseCode;
                    //card data individual for every transection type
                    $carddata = $responcedata->paymentInstrument;
                    $newInvoice->type = $carddata->type;

                    if ($carddata->type == 'UPI') {

                        if (isset($carddata->utr) && $carddata->utr != null) {
                            $newInvoice->utr = $carddata->utr;
                        } else {
                            $newInvoice->utr = "";
                        }
                        $userpaymentdetails['referenceid'] = $newInvoice->utr;
                        $userpaymentdetails['cardType'] = $carddata->type;

                    } else if ($carddata->type == 'CARD') {

                        $newInvoice->cardType = $carddata->type;
                        $newInvoice->pgTransactionId = $carddata->pgTransactionId;
                        $newInvoice->bankTransactionId = $carddata->bankTransactionId;
                        $newInvoice->pgAuthorizationCode = $carddata->pgAuthorizationCode;
                        $newInvoice->bankId = $carddata->bankId;
                        $newInvoice->arn = $carddata->arn;
                        $newInvoice->brn = $carddata->brn;

                        $userpaymentdetails['cardType'] = $carddata->cardType;
                        $userpaymentdetails['referenceid'] = $carddata->pgTransactionId;

                    } else if ($carddata->type == 'NETBANKING') {
                        $newInvoice->pgTransactionId = $carddata->pgTransactionId;
                        $newInvoice->bankTransactionId = $carddata->bankTransactionId;
                        $newInvoice->bankId = $carddata->bankId;
                        $newInvoice->pgServiceTransactionId = $carddata->pgServiceTransactionId;

                        $userpaymentdetails['referenceid'] = $carddata->pgTransactionId;
                        $userpaymentdetails['cardType'] = $carddata->type;

                    } else {
                    }

                    $userpaymentdetails['amount'] = $responcedata->amount / 100;
                    $userpaymentdetails['paymentstatus'] = $responcedata->state;
                    $userpaymentdetails['responseCode'] = $responcedata->responseCode;
                    //dd($newInvoice);

                    if ($newInvoice->save()) {

                        $userpaymentdetails['date'] = date("Y-m-d");
                        $userpaymentdetails['time'] = date("h:i a");
                        $userpaymentdetails['status'] = 1;
                        $userpaymentdetails['msg'] = "Thank you for
                        your interest. Your appointment has been scheduled. Our team will connect with you, take care of the
                        details, and guide you accordingly.";
                        $userpaymentdetails['appointmentid'] = $appointmentid->id;
                        $updatedata['payment_status'] = "c";
                        $updateappointment = Appointment::where('id', '=', $appointmentid->id)->update($updatedata);

                        //dd($userpaymentdetails);
                        return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);

                    } else {

                        $userpaymentdetails['status'] = 0;
                        $userpaymentdetails['msg'] = "Your payment has been processed successfully. We are in the process of updating our records. We’ll notify you once it’s completed. Thanks for bearing with us!";
                        //return with error msg
                        return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);
                    }

                } else {

                    if (isset($response->data)) {
                        $userpaymentdetails['msg'] = $response->data->responseCodeDescription;
                    } else {
                        $userpaymentdetails['msg'] = "Payment failed, Please try again";
                    }

                    $userpaymentdetails['status'] = 0;
                    //return with error msg
                    return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);
                }
            } else {

                $userpaymentdetails['status'] = 0;
                $userpaymentdetails['msg'] = "Payment failed, Please try again";
                //return with error msg
                return view('front.booking', ['page_name' => 'Booking', 'userpaymentdetails' => $userpaymentdetails]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function generatePDF($id)
    {
        //dd($id);
        $apoinmentdetails = Appointment::leftJoin('users', 'users.id', '=', 'appointments.userId')->where('appointments.id', $id)->leftJoin('invoices', 'invoices.appointmentId', '=', 'appointments.id')->where('appointments.id', $id)->select('users.name', 'users.email', 'appointments.phoneNumber', 'appointments.bookingDate', 'appointments.appointmentType', 'appointments.created_at', 'invoices.*')->first();

        $data = [
            'title' => 'Invoice for Astro Achariya Debdutta Appointment',
            'image' => public_path('admin/img/astroachariyalogo.png'),
            'rupee' => public_path('admin/img/rupee.png'),
            'date' => $apoinmentdetails->created_at->format('d M Y - H:i:s'),
            'users' => $apoinmentdetails
        ];

        //dd($apoinmentdetails->created_at);
        Pdf::setOption(['defaultFont' => 'Poppin, sans-serif']);
        $pdf = PDF::loadView('front.invoicepdf', $data)->setPaper('a4', 'potraite');
        $path = public_path('admin/invoices');
        $fileName = 'invoiceAAD' . $apoinmentdetails->invoiceId . '.pdf';
        $pdf->save($path . '/' . $fileName);
        return $pdf->download('invoiceAAD' . $apoinmentdetails->invoiceId . '.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, phonepe $phonepe)
    {
        //
    }

    /**
     * Phonepelink
     */
    public function paymentlinkcreate(Request $request)
    {
        $data = $request->except('_token');

        // dd(vars: $data);
        $id = $data['id'];
        $phonepedata = phonepe::first();

        $users = User::leftJoin('appointments', 'users.id', '=', 'appointments.userId')->select('appointments.phoneNumber', 'users.name', 'users.id')->where('appointments.id', $id)->first();

        $username = preg_replace('/\s+/', '', $users->name);
        $merchantTransactionId = substr(strtoupper($username), 0, 4) . time();

        $data = array(
            "merchantId" => 'M222S7BESZIL0',
            "transactionId" => 'AADD' . $merchantTransactionId,
            "merchantOrderId" => 'AADD' . $merchantTransactionId,
            "amount" => 100,
            "mobileNumber" => $users->phoneNumber,
            "message" => "paylink for " . $users->name,
            "expiresIn" => 3600,
            "storeId" => "store" . $id,
            "terminalId" => "terminal" . $id,
            "shortName" => $users->name,
            "subMerchantId" => "Astro Achariya Debdutta"
        );

        $encode = base64_encode(json_encode($data));

        $saltKey = '2e38a700-f726-49b6-ae86-70421c78577a';
        $saltIndex = $phonepedata->apiindex;

        $string = $encode . '/v3/payLink/init' . '2e38a700-f726-49b6-ae86-70421c78577a';
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;
        //dd($finalXHeader);
        $url = 'https://mercury-uat.phonepe.com/enterprise-sandbox/v3/payLink/init';
        $response = Curl::to($url)
            ->withHeader('Content-Type:application/json')
            ->withHeader('X-VERIFY:' . $finalXHeader)
            ->withHeader('X-CALLBACK-URL:' . route('response'))
            ->withData(json_encode(['data' => $encode]))
            ->post();

        $rData = json_decode($response);
        dd($rData);
        if ($rData->success == true) {
            //dd($rData);
            $updatedata['merchantTransactionId'] = $rData->data->merchantTransactionId;
            $updateappointment = Appointment::where('id', '=', $id)->update($updatedata);
            return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        } else {
            session(['status' => "0", 'msg' => 'Payment failed, Please try again']);
            return redirect()->back();
        }
    }
}