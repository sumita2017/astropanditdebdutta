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
                About us Contact us details
            </div>
            <div class="card-body">

                @if(empty($aboutcontactus))
                    <h5>No About us and Contact us are added</h5>
                @else
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button btn-secondary " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="true"
                                    aria-controls="flush-collapseOne" style="background:#d9e3ef;">
                                    About us details
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show "
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-primary me-md-2" data-bs-toggle="modal"
                                                data-bs-target="#editaboutus"
                                                style="
                                                                                                                padding-left: 80px;
                                                                                                                padding-right: 80px;">Edit</button>
                                        </div>
                                    </div>
                                    <div>
                                        <img src=" {{ URL::to('about') . "/" . $aboutcontactus->image }}"
                                            class="rounded img-fluid  float-end img-thumbnail" id="showimage"
                                            alt="no old image" hight=20% width=20%>
                                    </div>
                                    <div class="row">
                                        <p>
                                            {!! html_entity_decode($aboutcontactus->title) !!}
                                        </p>

                                        <p>{!! html_entity_decode($aboutcontactus->homedescription) !!}</p>

                                        <p>{!! html_entity_decode($aboutcontactus->description) !!}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo" style="background:#d9e3ef;">
                                    Contact us Detais
                                </button>

                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-primary me-md-2" data-bs-toggle="modal"
                                                data-bs-target="#editcontactus"
                                                style="
                                                                                                                padding-left: 80px;
                                                                                                                padding-right: 80px;">Edit</button>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="d-flex mb-4">
                                            <div>
                                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                            </div>
                                            <div class="ps-4">
                                                <h4 class="h5">Location</h4>
                                                <p class="mb-0">{{$aboutcontactus->address}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div>
                                                <i class="fa-solid fa-phone fa-xl"></i>
                                            </div>
                                            <div class="ps-4">
                                                <h4 class="h5 ">Phone</h4>
                                                <p class="mb-2">{{$aboutcontactus->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <i class="fa-brands fa-whatsapp fa-xl"></i></i>
                                            </div>
                                            <div class="ps-4">
                                                <h4 class="h5 ">Whatsapp</h4>
                                                <p class="mb-4">{{$aboutcontactus->whatsapp}}</p>
                                            </div>
                                        </div>

                                        <div class="d-flex">
                                            <div>
                                                <i class="fa-regular fa-envelope fa-xl"></i>
                                            </div>
                                            <div class="ps-4">
                                                <h4 class="h5 ">Email</h4>
                                                <p class="mb-2">{{$aboutcontactus->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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