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
                Contacts us form data
            </div>
            <div class="card-body">

                @if(count($contactus) === 0)
                <h5>No Contacts are listed</h5>
                @else
                <table id="datatablesSimple" class="servicetable">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($contactus as $data)
                        <tr>
                            <td>{{ $data->fullname }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ substr( $data->message, 0, 100) }}
                                <a class="more" msg="{{$data->message}}">
                                    ...more
                                </a>
                            </td>
                            <td>
                                <a title="Delete Contact" class="btn btn-danger deletecontact" contactid="{{ base64_encode($data->id)}}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
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