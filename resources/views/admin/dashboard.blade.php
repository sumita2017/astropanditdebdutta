@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>
        <div class="row">
            @foreach ($appointments as $appointment)

                <div class="col-xl-4 col-md-6 p-bottom-20">
                    <div class="card text-bg-light">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ URL::to('appoinmentdetails') . '/' . base64_encode($appointment->id) }}"
                                        style="color: #1f70d5;">
                                        <h5>{{$appointment->name}}</h5>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    @if($appointment->payment_status == "n")
                                        <button class="btn btn-primary btn-xs paymentamout" data-bs-toggle="modal"
                                            data-bs-target="#paymentmodal" id="{{$appointment->id}}" name="{{$appointment->name}}"
                                            email="{{$appointment->email}}" phone="{{$appointment->phoneNumber}}"
                                            bookingdate="{{ $appointment->bookingDate }}">Payment Link</button>
                                        <!-- Payment not done -->
                                    @elseif($appointment->payment_status == "p")
                                        Pending
                                    @else
                                        Payment Completed
                                    @endif

                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $appointment->email }}</li>
                            <li class="list-group-item">{{ $appointment->phoneNumber }}</li>
                            <li class="list-group-item"><a
                                    href="https://wa.me/91{{$appointment->whatsappNumber}}?text=Thank%20you%20behalf%20of%20Astro%20Achariya%20debdutta%20for%20connecting%20with%20us">{{ $appointment->whatsappNumber }}</a>
                            </li>
                            <li class="list-group-item">{{ $appointment->bookingDate }}</li>
                            @if($appointment->appointmentType == "o")
                                <li class="list-group-item"><i class="fa fa-video-camera" aria-hidden="true"></i> Online </li>
                            @else
                                <li class="list-group-item"><i class="fa fa-male" aria-hidden="true"></i> Offline </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection