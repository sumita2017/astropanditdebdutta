@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Service</h2>
        <div class="row">

            <form class="user" id="formdata" method="POST" action="{{ URL::to('updateservice') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="mt-4">
                    <label class="control-label">Service Name</label>
                    <input type="text" class="form-control form-control-user" placeholder="Service Name" name="name" value="{{$servicedata->name}}" required autofocus>
                </div>

                <input type="hidden" value="{{$servicedata->id}}" name="id">

                <div class="mt-4">
                    <label class="control-label">Short Description</label>
                    limit <span class="limit">0</span>/100
                    <textarea name="shortdescription" class="form-control form-control-user" id="shortdescription" aria-describedby="shortdescription" maxlength="200">{{$servicedata->shortdescription}}</textarea>
                </div>

                <div class="mt-4">
                    <label class="control-label">Description</label>
                    limit <span class="limit">0</span>/2000
                    <textarea name="description" class="form-control form-control-user" id="description" aria-describedby="description" maxlength="2000" rows="10" cols="50">{!! html_entity_decode($servicedata->description)!!}</textarea>
                </div>

                <div class="mt-4">
                    <label>Service Image</label>
                </div>
                <div class="mt-4">
                    <img src="{{ URL::to('service')."/".$servicedata->Image }}" class="rounded img-fluid" id="showimage" alt="no old image" hight=10% width=10%>
                </div>

                <div class="mt-4">
                    <label>Upload Service Image</label>
                    <inpuT type="hidden" name="oldimage" value="{{$servicedata->Image}}">
                    <input type="file" class="form-control newimage" name="fileToUpload" id="fileToUpload" value="" accept="image/png, image/gif, image/jpeg, image/jpg">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        Edit Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection