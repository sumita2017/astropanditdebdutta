@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!-- Start Contact -->
<section id="contact" class="p-top-80 p-bottom-50">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="section-title text-center m-bottom-40">

                <p class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s" style="color:black">
                    {{ $userpaymentdetails['msg'] }}
                </p>

            </div>

            <!-- === Contact Form === -->
            <div class="col-md-8 col-sm-8 col-md-offset-2 p-bottom-30">
                @if($userpaymentdetails['status'] == 1)
                                @php
                                    $about_contact = aboutalldetails();
                                @endphp
                                <!-- invoice -->
                                <div class="card">
                                    <div class="card-header bg-black"></div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled pull-left">
                                                            <li style="font-size: 30px; color: #b4975d;">Customer Details</li>
                                                            <li style="font-size: 14px; color: black !important;">
                                                                Name:{{ $userpaymentdetails['customername'] }}</li>
                                                            <li style="font-size: 14px; color: black !important;">
                                                                Email:{{ $userpaymentdetails['customeremail'] }}</li>
                                                            <li style="font-size: 14px; color: black !important;">Phone
                                                                number:{{ $userpaymentdetails['customerphonenumber'] }}
                                                            </li>
                                                            <li style="font-size: 14px; color: black !important;">Transection
                                                                ID:{{ $userpaymentdetails['merchantTransactionId'] }}</li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled pull-right">
                                                            <li style="font-size: 30px; color: red;">
                                                                <img class="logo" src="{{ URL::to('admin/img/astroachariyalogo.png') }}"
                                                                    alt="logo" data-rjs="2"
                                                                    style="background-color: black;width: 65%;height: 55px;">
                                                            </li>
                                                            <li>
                                                                @foreach ($about_contact->phone as $phone)
                                                                    <a style="font-size: 14px; color: black !important;"
                                                                        href="tel:+91{{$phone}}">+91{{$phone}}</a> &nbsp; &nbsp; &nbsp;
                                                                @endforeach
                                                            </li>
                                                            <li style="font-size: 14px; color: black !important;"><i
                                                                    class="fa fa-whatsapp" aria-hidden="true"></i> +91 <a
                                                                    style="font-size: 14px; color: black !important;"
                                                                    href="https://wa.me/91{{ $about_contact->whatsapp }}?text=Thank%20you%20behalf%20of%20Astro%20Achariya%20debdutta%20for%20connecting%20with%20us">{{ $about_contact->whatsapp }}</a>
                                                            </li>
                                                            <li style="font-size: 14px; color: black !important;">
                                                                {{ $about_contact->email }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <h3 class="text-uppercase text-center mt-3" style="font-size: 40px;">Invoice</h3>
                                                    <p> ID #{{ $userpaymentdetails['invoiceId']}}</p>
                                                </div>
                                            </div>

                                            <div class="row mx-3">
                                                <div class="col-md-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Appointment: {{ $userpaymentdetails['appointmentType']}}</td>
                                                                <td><i class="fa fa-inr"
                                                                        aria-hidden="true"></i>{{ $userpaymentdetails['amount'] }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <p class="pull-right"
                                                        style="font-size: 30px; color: #b4975d; font-weight: 400;font-family: Arial, Helvetica, sans-serif;margin-right: 20%;">
                                                        Total:
                                                        <span>
                                                            <i class="fa fa-inr"
                                                                aria-hidden="true"></i>{{ $userpaymentdetails['amount'] }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row mt-2 mb-5">
                                                <div class="col-xl-8 col-md-8 col-sm-8">
                                                    <p class="fw-bold">Date: <span
                                                            class="text-muted">{{ $userpaymentdetails['date']}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <a href="{{ URL::to('generate-pdf') . '/' . $userpaymentdetails['appointmentid']}}"
                                                        type="button" class="btn btn-default" style="background-color: #be994f;"><i
                                                            class="fa fa-print" aria-hidden="true"></i>
                                                        Download Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-black"></div>
                                </div>
                @endif
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<!-- End Contact -->
@endsection