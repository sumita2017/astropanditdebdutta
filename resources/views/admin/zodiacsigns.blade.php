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
            Zodiac Signs
        </div>
        <div class="card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button btn-secondary " type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne"
                            style="background:#d9e3ef;">
                            Upload Zodiac Signs
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse show "
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="card-body">
                                    <table id="datatablezodiac" class="table datatablereview">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Zodiac Name</th>
                                                <th>Zodiac Image</th>
                                                <th>Nature</th>
                                                <th>Color Type</th>
                                                <th>Planet</th>
                                                <th>Upload Image Type</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Zodiac Name</th>
                                                <th>Zodiac Image</th>
                                                <th>Nature</th>
                                                <th>Color Type</th>
                                                <th>Planet</th>
                                                <th>Upload Image Type</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($zodiacdata as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $data->zodiac_name }}</td>
                                                <td>
                                                    @if(isset($data->image) & $data->image != null)
                                                        @php
                                                            $oldimage = $data->image;
                                                        @endphp
                                                        <img src="{{ URL::to('zodiac') . "/" . $data->image }}" class="img-circle uploadedsign"
                                                            id="uploadedsign{{$data->id}}" alt="zodiac image" width="100px" height="100px">
                                                    @else
                                                    @php
                                                        $oldimage = "";
                                                    @endphp
                                                    <img src="" class=" img-circle uploadedsign" id="uploadedsign{{$data->id}}" alt="zodiac image" width="100px"
                                                        height="100px">
                                                    <div class="noimage"> No Image Uploaded </div>
                                                    @endif
                                                        </td>
                                                        </td>
                                                        <td>{{ $data->nature }}</td>
                                                        <td>{{ $data->colortype }}</td>
                                                        <td>
                                                            <p id="planet{{$data->id}}">{{ $data->planet }}</p>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-primary zodiacedit" zodiacid="{{$data->id}}"
                                                                oldimage="{{ $oldimage }}"><i class="fa-regular fa-pen-to-square"></i></button>
                                                        </td>
                                                    </tr>
                                                    @php    $i++ @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--  -->
                                </div>
                                <div>

                                </div>
                                <div class="row">

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