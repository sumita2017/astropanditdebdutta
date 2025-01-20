@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Banner and Video</h2>
        <div class="row">

            <form class="user" id="formdata7" method="POST" action="{{ URL::to('updatebannervideo') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" value="{{$bannervideodata->id}}" name="id">
                <div class="mt-4">
                    <img src="{{ URL::to('bannervideo')."/".$bannervideodata->thumbnail }}" class="rounded img-fluid" id="showimage" alt="no old iamge" hight=10% width=10%>
                </div>

                <div class="mt-4">
                    <label>Upload Thumbnail Image</label>
                    <inpuT type="hidden" name="oldimage" value="{{$bannervideodata->thumbnail}}">
                    <input type="file" class="form-control newimage" name="fileToUpload" id="editfileToUpload2" accept="image/png, image/gif, image/jpeg, image/jpg">
                </div>

                <div class="mt-4">
                    <label class="control-label">Video link </label>
                    @php
                    if(is_null($bannervideodata->videolink)){
                    $placehoslder=" https://www.youtube.com/@AchariyaDebdutta";
                    }else{
                    $placehoslder = $bannervideodata->videolink;}
                    @endphp
                    <input type="url" pattern="https://.*" class="form-control form-control-user" placeholder="{{$placehoslder}}" name="videolink" value="{{$bannervideodata->videolink}}" autofocus>
                </div>

                <div class="mt-4 bannertextsection">
                    <label class="control-label">File Type</label>

                    <div class="form-check">
                        @php
                        $banner="";
                        $video="";
                        $hide="";
                        $show="";
                        @endphp

                        @if($bannervideodata->thumbnailtype == 0)
                        @php
                        $banner="checked";
                        $textareadisplay='style="display: block;"';
                        @endphp
                        @else
                        @php
                        $video="checked";
                        $textareadisplay='style="display: none;"';
                        @endphp
                        @endif

                        <input class="form-check-input filetypebannervideo" type="radio" name="thumbnailtype" id="editflexRadioDefault1" value="0" {{$banner}}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Banner
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input filetypebannervideo" type="radio" name="thumbnailtype" id="editflexRadioDefault2" value="1" {{$video}}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Video panel
                        </label>
                    </div>
                </div>

                <div class="mt-4 bannertextshow" {!! $textareadisplay !!} maxlength="50">
                    <label class="control-label">Banner Text </label>
                    <textarea class="form-control form-control-user" id="textareabanneredit" name="bannertext" rows="3">{!! html_entity_decode($bannervideodata->bannertext)!!}</textarea>
                </div>

                <div class="mt-4">
                    <label class="control-label">File Visibility</label>
                    @if($bannervideodata->show == 0)
                    @php
                    $hide="checked";
                    @endphp
                    @else
                    @php
                    $show="checked";
                    @endphp
                    @endif

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="show" id="editflexRadioDefault4" value="1" {{$show}}>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Show
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="show" id="editflexRadioDefault3" value="0" {{$hide}}>
                        <label class="form-check-label" for="flexRadioDefault3">
                            Hide
                        </label>

                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        Edit Banner or Video
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection