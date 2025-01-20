@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!-- Start Contact -->
<section id="contact" class="p-top-80 p-bottom-50">
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="background-color: #faf0e6;">
                <!-- Section Title -->
                <div class="section-title text-center m-bottom-40">
                    <img src="{{ URL::to('frontend/img/llogo icon-01-01.png') }}" class="checkoutimage" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                    <h2 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s">Checkout Details</h2>
                    <div class="divider-center-small wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s"></div>
                </div>
            </div> <!-- /.col -->
        </div> <!-- /.row -->


        <!-- === Contact Form === -->
        <div class="col-md-6 col-sm-6 col-md-offset-3 p-bottom-30">
            <div class="row">
                <section class="h-100 h-custom" style="background-color: #faf0e6;">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-md-4 col-md-4 col-md-offset-1">
                                <div class="card rounded-4" style="padding-right: 10px;">
                                    <div class="text-center">
                                        <div class="card-body p-4 p-md-5">

                                            <ul class="list-group chackoutlist">
                                                <li class="list-group-item">Name: {{$appointment->name}}</li>
                                                <li class="list-group-item">Email: {{$appointment->email}}</li>
                                                <li class="list-group-item">Phone Number: {{$appointment->phoneNumber}}</li>
                                                <li class="list-group-item">
                                                    <div class="price-item-price">
                                                        <p class="big"><span class="currency"><i class="fa fa-inr" aria-hidden="true"></i></span>1500</p>
                                                    </div>
                                                    <a href="#" class="btn btn-main btn-transparent " data-toggle="modal" data-target="#chackoutmodal">Chackout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div> <!-- /.contacts-form & inner row -->
        </div> <!-- /.col -->

    </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<!-- End Contact -->
@endsection