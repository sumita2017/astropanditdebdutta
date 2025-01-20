@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4"><strong>
                @if ($page_name === null)
                    client
                @else
                    {{ $page_name}}
                @endif
            </strong>
        </h2>

        <!-- to show the session status message -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                About us Contact us details
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <a href="{{ URL::to('generate-pdf') . '/' . $appointment['id']}}" type="button"
                            class="btn btn-default" style="background-color: #f3ae30;"><i class="fa fa-print"
                                aria-hidden="true"></i>
                            Print Invoice</a>
                    </div>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button btn-secondary " type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                aria-controls="flush-collapseOne" style="background:#d9e3ef;">
                                Appointment of {{ $appointment->name}}
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show "
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"> Name : {{ $appointment->name }} </li>
                                        <li class="list-group-item"> Email :
                                            @if($appointment->email) {{ $appointment->email }}
                                            @endif
                                        </li>
                                        <li class="list-group-item"> Phone Number : {{ $appointment->phoneNumber }}
                                        </li>
                                        <li class="list-group-item"> Whatsapp Number :
                                            <a
                                                href="https://wa.me/91{{$appointment->whatsappNumber}}?text=Thank%20you%20behalf%20of%20Astro%20Achariya%20debdutta%20for%20connecting%20with%20us">{{ $appointment->whatsappNumber }}</a>
                                        </li>
                                        <li class="list-group-item"> Gender :
                                            @if($appointment->gender == "m")
                                                Male
                                            @elseif($appointment->gender == "f")
                                                Female
                                            @elseif($appointment->gender == "0")
                                                Other
                                            @else
                                                Male
                                            @endif
                                        </li>
                                        <li class="list-group-item"> Date Of Birth : {{ $appointment->dateOfBirth }}
                                        </li>
                                        <li class="list-group-item"> Place Of Birth : {{ $appointment->placeOfBirth }}
                                        </li>
                                        <li class="list-group-item"> State Of Birth : {{ $appointment->stateOfBirth }}
                                        </li>
                                        <li class="list-group-item"> Time Of Birth : {{ $appointment->timeOfBirth }}
                                        </li>
                                        <li class="list-group-item"> Booking Date : {{ $appointment->bookingDate }}</li>
                                        <li class="list-group-item"> Appointment Type :
                                            @if($appointment->appointmentType == 'o')
                                                <i class="fa fa-video-camera" aria-hidden="true"></i> Online
                                            @else
                                                <i class="fa fa-male" aria-hidden="true"></i> Offline
                                            @endif
                                        </li>
                                        <li class="list-group-item"> Chamber :
                                            @if($appointment->appointmentType == 'm')
                                                {{ $appointment->locationname }}
                                            @else
                                                No chamber needed
                                            @endif
                                        </li>
                                        <li class="list-group-item"> Payment Status :
                                            @if($appointment->payment_status == "n")
                                                "Not done"
                                            @elseif($appointment->payment_status == "p")
                                                Pending
                                            @else
                                                "Completed"
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection