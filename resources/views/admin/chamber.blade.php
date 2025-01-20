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

        <div class="card mb-4">
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addchamber">Add new Chamber</button>
        </div>

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
                Chamber
            </div>
            <div class="card-body">

                @if(count($chamberdata) === 0)
                <h5>No Chamber are added</h5>
                @else
                <table id="datatablesSimple" class="servicetable">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Available Days</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Location</th>
                            <th>Available Days</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($chamberdata as $data)
                        <tr>
                            <td>{{ $data->locationname }}</td>

                            <td>{{ $data->availabledays }}</td>
                            <td>{{ $data->description }}</td>
                            <td>
                                <a style="font-size: medium;" title="Edit Chamber" class="btn btn-warning" href="{{ URL::to('editchamber/' .base64_encode($data->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i></a>

                                <a title="Delete Chamber" class="btn btn-danger deletechember" chamberid="{{ base64_encode($data->id)}}"><i class="fas fa-trash"></i></a>
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