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
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addservice">Add new Service</button>
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
                Services
            </div>
            <div class="card-body">

                @if(count($servicedata) === 0)
                <h5>No services are added</h5>
                @else
                <table id="datatablesSimple" class="servicetable">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Image</th>
                            <th>Short Description</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Service Name</th>
                            <th>Image</th>
                            <th>Short Description</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($servicedata as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>
                                <div class="text-center">
                                    <img src="{{ URL::to('service')."/".$data->Image }}" class="rounded  img-fluid" alt="..." hight=200px width=200px>
                                </div>
                            </td>
                            <td>{{ strip_tags($data->shortdescription) }}</td>
                            @php
                            $small = substr( strip_tags($data->description), 0, 200);

                            @endphp
                            <td>{{ $small }}<a class="more" descriptiondata="{!!htmlentities($data->description)!!}">
                                    ...more
                                </a></td>
                            <td>
                                <a style="font-size: medium; " title="Edit Service" class="btn btn-warning" href="{{ URL::to('editservice/' .base64_encode($data->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i></a>

                                <a title="Delete Service" class="btn btn-danger deleteservice" serviceid="{{ base64_encode($data->id)}}" serviceimage="{{ $data->Image }}"><i class="fas fa-trash"></i></a>
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