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
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addcustomerreview">Add new Review</button>
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
                Admin Review table
            </div>
            <div class="card-body">
                <table id="datatablereview" class="table datatablereview">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th class="review">Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th class="review">Review</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($reviews as $data)
                        <tr>
                            <td>{{ $i  }}</td>
                            <td>{{ $data->user_name }}</td>
                            <td class="review">{{ $data->review }}</td>
                            <td>
                                <a style="font-size: medium; margin-right:20px;" title="Edit Banner Video" class="btn btn-warning" href="{{ URL::to('editreview/' .base64_encode($data->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i></a>

                                <a title="Delete Review" class="btn btn-danger deletereview" reviewid="{{ base64_encode($data['id'])}}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection