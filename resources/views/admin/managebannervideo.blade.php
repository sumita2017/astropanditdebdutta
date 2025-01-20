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
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addbannervideo">Add new Banner or Videos</button>
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
                Banners
            </div>
            <div class="card-body">

                @if(count($bannerthumbnail) === 0)
                <h5>No Banner or Videos are added</h5>
                @else
                <table id="bannerdatatable" class="servicetable">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>File Type</th>
                            <th>Banner Text</th>
                            <th>Created At</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Thumbnail</th>
                            <th>File Type</th>
                            <th>Banner Text</th>
                            <th>Created At</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($bannerthumbnail as $key => $data)
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{ URL::to('bannervideo')."/".$data->thumbnail }}" class="rounded  img-fluid" alt="..." hight=200px width=200px>
                                </div>
                            </td>
                            <td>
                                @if($data->thumbnailtype == 0)Banner Panel @elseif($data->thumbnailtype == 1) Video Panel @endif
                            </td>
                            <td>
                                {{$data->bannertext}}
                            </td>
                            <td> {{date('jS F Y',strtotime($data->created_at))}}</td>
                            <td>
                                @if( $data->show == 0)Hide @elseif($data->show == 1) Show @endif
                            </td>
                            <td>
                                <a style="font-size: medium;" title="Edit Banner Video" class="btn btn-warning" href="{{ URL::to('editbannervideo/' .base64_encode($data->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i></a>
                                @if ($key != 0)
                                    <a title="Delete Banner Video" class="btn btn-danger deletebannervideo" bannervideoid="{{ base64_encode($data->id)}}" bannervideoimage="{{$data->thumbnail}}"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Videos
            </div>
            <div class="card-body">

                @if(count($videothumbnail) === 0)
                <h5>No Banner or Videos are added</h5>
                @else
                <table id="youtubedatatable" class="servicetable">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Video Link</th>
                            <th>File Type</th>
                            <th>Created At</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Video Link</th>
                            <th>File Type</th>
                            <th>Created At</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($videothumbnail as $data)
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{ URL::to('bannervideo')."/".$data->thumbnail }}" class="rounded  img-fluid" alt="..." hight=200px width=200px>
                                </div>
                            </td>
                            <td><a href="{{ $data->videolink }}" target="_blank">{{ $data->videolink }}</a></td>
                            <td>
                                @if($data->thumbnailtype == 0)Banner Panel @elseif($data->thumbnailtype == 1) Video Panel @endif
                            </td>
                            <td> {{date('jS F Y',strtotime($data->created_at))}}</td>
                            <td>
                                @if( $data->show == 0)Hide @elseif($data->show == 1) Show @endif
                            </td>
                            <td>
                                <a style="font-size: medium;" title="Edit Banner Video" class="btn btn-warning" href="{{ URL::to('editbannervideo/' .base64_encode($data->id)) }}"><i class="fas fa-edit" style="color:#848795;"></i></a>

                                <a title="Delete Banner Video" class="btn btn-danger deletebannervideo" bannervideoid="{{ base64_encode($data->id)}}" bannervideoimage="{{$data->thumbnail}}"><i class="fas fa-trash"></i></a>
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