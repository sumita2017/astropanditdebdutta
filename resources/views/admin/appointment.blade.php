@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">
            @if ($page_name === null)
                client
            @else
                {{ $page_name}}
            @endif
        </h2>

        <!-- to show the session status message -->
        @php
            $sessiondata = session()->all();

        @endphp
        @if(session()->has('status') && session()->has('msg'))
                @if($sessiondata['status'] === '1')
                    <div class="alert alert-info sessiondata" role="alert">{{ $sessiondata['msg'] }}</div>
                @else
                    <div class="alert alert-danger sessiondata" role="alert">{{ $sessiondata['msg'] }}</div>
                @endif
                @php
                    session()->forget(['status', 'msg']);
                @endphp
        @endif


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Appointments
            </div>
            <div class="card-body">

                @if(count($appointments) === 0)
                    <h5>No Appointments are available</h5>
                @else
                                <table id="appointmenttable" class="servicetable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp Number</th>
                                            <th>Appointment Type</th>
                                            <th>Booking Date</th>
                                            <th>Chamber</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Whatsapp Number</th>
                                            <th>Appointment Type</th>
                                            <th>Booking Date</th>
                                            <th>Chamber</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $a = 0;
                                        @endphp
                                        @foreach ($appointments as $data)
                                                            <tr>
                                                                <td>{{$a}}</td>
                                                                <td>
                                                                    <a href="{{ URL::to('appoinmentdetails') . '/' . base64_encode($data->id) }}"
                                                                        role="button" aria-disabled="true"
                                                                        title="This Appointment Details">{{ $data->name }}<i
                                                                            class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                                <td>{{ $data->email }}</td>
                                                                <td>{{ $data->phoneNumber }}</td>
                                                                <td><a
                                                                        href="https://wa.me/91{{$data->whatsappNumber}}?text=Thank%20you%20behalf%20of%20Astro%20Achariya%20debdutta%20for%20connecting%20with%20us">{{ $data->whatsappNumber }}</a>
                                                                </td>
                                                                @if($data->appointmentType == "o")
                                                                    <td><i class="fa fa-video-camera" aria-hidden="true"></i> Online </td>
                                                                @else
                                                                    <td><i class="fa fa-male" aria-hidden="true"></i> Offline </td>
                                                                @endif
                                                                <td>{{ $data->bookingDate }}</td>
                                                                @if($data->appointmentType == "o")
                                                                    <td>Online</td>
                                                                @else
                                                                    <td><i class="fa fa-map-marker" aria-hidden="true"></i>
{{ $data->locationname }}</td>
                                                                @endif
                                                                <td>
                                                                    @if($data->payment_status == "n")
                                                                        <button class="btn btn-danger btn-xs paymentamout" data-bs-toggle="modal"
                                                                            data-bs-target="#paymentmodal" id="{{$data->id}}" name="{{$data->name}}"
                                                                            email="{{$data->email}}" phone="{{$data->phoneNumber}}"
                                                                            bookingdate="{{ $data->bookingDate }}">
                                                                            <i class="fa fa-link" aria-hidden="true"></i>
                                                                        </button>
                                                                    @elseif($data->payment_status == "p")
                                                                        Pending
                                                                    @else
                                                                        <a href="{{ URL::to('generate-pdf') . '/' . $data->id}}" type="button"
                                                                            class="btn btn-success" title="download invoice"><i class="fa fa-print"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $a++;
                                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                @endif
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection