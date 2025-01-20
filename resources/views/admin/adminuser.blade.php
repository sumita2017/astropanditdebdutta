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
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addadminuser">Add new admin</button>
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
                Admin User table
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($adminuserdata as $userdata)
                        @php
                        if($userdata->usertype ==='0'){
                        $usertype = 'Master Admin';
                        }elseif($userdata->usertype ==='1'){
                        $usertype = 'Sub Admin';
                        }elseif($userdata->usertype ==='2'){
                        $usertype = 'Seo management';
                        }elseif($userdata->usertype ==='3'){
                        $usertype = 'Guest';
                        }elseif($userdata->usertype ==='4'){
                        $usertype = 'Appointment Management';
                        }elseif($userdata->usertype ==='5'){
                        $usertype = 'Blog Management';
                        }else{
                        $usertype = 'Others';
                        }

                        @endphp
                        <tr>
                            <td>{{ $userdata->name }}</td>
                            <td>{{ $usertype }}</td>
                            <td>{{ $userdata->email }}</td>
                            <td>
                                @if($userdata->usertype != '0')
                                <a style="font-size: medium;" title="Edit Admin" class="btn btn-warning" href="{{ URL::to('editadmin/' .base64_encode($userdata->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i>Edit Admin</a>

                                <a title="Delete Admin" class="btn btn-danger deleteadmin" adminid="{{ base64_encode($userdata->id)}}"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
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