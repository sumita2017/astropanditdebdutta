<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\chamber;
use App\Models\invoice;
use App\Models\phonepe;
use Illuminate\Support\Carbon;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminappointment()
    {
        $appointments = Appointment::orderBy('bookingDate', 'desc')->get();
        //dd($appointments);
        foreach ($appointments as $appointment) {

            // user details related to this appointment
            $user = User::select('name', 'email')->where('id', $appointment->userId)->first();
            $appointment->name = $user->name;
            $appointment->email = $user->email;

            // chamber details related to this appointment
            if ($appointment->appointmentType == 'm') {
                $chamber = chamber::select('locationname')->where('id', $appointment->chamberId)->first();
                $appointment->locationname = $chamber->locationname;
            } else {

                $appointment->locationname = null;
            }

            $timestamp1 = strtotime($appointment->dateOfBirth);
            $appointment->dateOfBirth = Carbon::parse($timestamp1)->format('d F, Y');

            $timestamp2 = strtotime($appointment->bookingDate);
            $appointment->bookingDate = Carbon::parse($timestamp2)->format('d-m-Y');
        }
        //dd($appointments);
        return view('admin.appointment', ['page_name' => 'Appointment', 'navstatus' => "adminappointment", 'appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function appointment()
    {
        $allchamber = chamber::select('id', 'locationname')->get();
        //dd($allchamber);
        $paymentdetails = phonepe::select('paymentamount')->first();

        return view('front.appoinment', ['allchamber' => $allchamber, 'navstatus' => "adminappointment", 'paymentamount' => (int) $paymentdetails->paymentamount / 100]);
    }

    public function adminappoinmentdetails($id)
    {
        $id = base64_decode($id);
        $appointment = Appointment::where('id', $id)->first();

        // user details related to this appointment
        $user = User::select('name', 'email')->where('id', $appointment->userId)->first();
        $appointment->name = $user->name;
        $appointment->email = $user->email;

        // chamber details related to this appointment
        if ($appointment->appointmentType == 'm') {
            $chamber = chamber::select('locationname')->where('id', $appointment->chamberId)->first();
            $appointment->locationname = $chamber->locationname;
        } else {

            $appointment->locationname = null;
        }

        // invoice details related to this appointment
        $invoice = Invoice::select('id', 'status')->where('appointmentId', $appointment->id)->first();
        if (!empty($invoice)) {
            $appointment->invoiceId = $invoice->id;
            $appointment->invoicestatus = $invoice->status;
        } else {
            $appointment->invoiceId = null;
            $appointment->invoicestatus = $appointment->payment_status;
        }

        $timestamp1 = strtotime($appointment->dateOfBirth);
        $appointment->dateOfBirth = Carbon::parse($timestamp1)->format('d F, Y');

        $timestamp2 = strtotime($appointment->bookingDate);
        $appointment->bookingDate = Carbon::parse($timestamp2)->format('Y-m-d');

        dd($appointment);
        return view('admin.soloappointment', ['page_name' => 'Appointment', 'navstatus' => "adminappointment", 'appointment' => $appointment]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addappointment(Request $request)
    {
        $data = $request->except('_token');

        if ($data['appointmentType'] == 'o') {
            $data['chamberId'] = null;
        }

        $user = User::select('id')->where('email', $data['email'])->first();

        $userid = "";

        if ($user != null && $user->id != null) {
            $userid = $user->id;
        } else {

            $newuser = new User;
            $newuser->name = ucfirst($data['name']);
            $newuser->email = $data['email'];
            $newuser->password = "";
            $newuser->usertype = "3";
            $newuser->save();
            $userid = $newuser->id;
        }

        $dateOfBirth = date_create($data['dateOfBirth']);
        $bookingDate = date_create($data['bookingDate']);
        $timestamp = strtotime($data['timeOfBirth']);
        $timeOfBirth = Carbon::parse($timestamp)->format('H:i:s');
        $newappoinment = new Appointment;
        $newappoinment->userId = $userid;
        $newappoinment->merchantTransactionId = "";
        $newappoinment->phoneNumber = $data['phoneNumber'];
        $newappoinment->whatsappNumber = $data['whatsappNumber'];
        $newappoinment->gender = $data['gender'];
        $newappoinment->dateOfBirth = date_format($dateOfBirth, "Y-m-d H:i:s");
        $newappoinment->timeOfBirth = $timeOfBirth;
        $newappoinment->placeOfBirth = $data['placeOfBirth'];
        $newappoinment->stateOfBirth = $data['stateOfBirth'];
        $newappoinment->bookingDate = date_format($bookingDate, "Y-m-d H:i:s");
        $newappoinment->appointmentType = $data['appointmentType'];
        $newappoinment->chamberId = $data['chamberId'];
        $newappoinment->payment_status = "n";

        if ($newappoinment->save()) {
            $appoinmentid = $newappoinment->id;
            $id = $appoinmentid;
            $users = User::leftJoin('appointments', 'users.id', '=', 'appointments.userId')->where('appointments.id', $id)->first();
            //dd($users);
            return redirect()->route('phonepe', [base64_encode($appoinmentid)]);
        } else {
            return redirect()->back();
        }
    }
    /**
     * creating payment link for customer and taking amount
     */
    public function paymentlinkcreateform($id)
    {
        $id = base64_decode($id);
        // dd($id);
        $appointment = Appointment::select('userId', 'phoneNumber')->where('id', $id)->first();

        // user details related to this appointment
        $user = User::select('name', 'email')->where('id', $appointment->userId)->first();
        $appointment->name = $user->name;
        $appointment->email = $user->email;
        //dd($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
