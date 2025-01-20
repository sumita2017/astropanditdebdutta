@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Service</h2>
        <div class="row">
            <form class="user" id="formdata3" method="POST" action="{{ URL::to('updatechamber') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" value="{{$chamberdata->id}}" name="id">

                <div class="mt-4">
                    <label class="control-label">Chamber Location</label>
                    <input type="text" class="form-control form-control-user" placeholder="........" name="name" value="{{$chamberdata->locationname}}" required autofocus>
                </div>

                <div class="mt-4">
                    <label class="control-label">Available Days</label>

                    @php
                    $availabledays=$chamberdata->availabledays;
                    $sundaystatus="";
                    $mondaystatus="";
                    $tuesdaystatus="";
                    $wednesdaystatus="";
                    $thursdaystatus="";
                    $fridaystatus="";
                    $saturdaydaystatus="";
                    $alldays="";

                    foreach ($availabledays as $days){
                    if($days == 1){
                    $sundaystatus = 'checked';
                    }elseif($days == 2){
                    $mondaystatus = 'checked';
                    }elseif($days == 3){
                    $tuesdaystatus = 'checked';
                    }elseif($days == 4){
                    $wednesdaystatus = 'checked';
                    }elseif($days == 5){
                    $thursdaystatus = 'checked';
                    }elseif($days == 6){
                    $fridaystatus = 'checked';
                    }else{
                    $saturdaydaystatus = 'checked';
                    }
                    }
                    if(count($availabledays) === 7){
                    $alldays ='checked';
                    }

                    @endphp

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="1" name="day[]" {{$sundaystatus}}>
                        <label class="form-check-label" for="flexCheckDefault">
                            Sunday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="2" name="day[]" {{$mondaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Monday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="3" name="day[]" {{$tuesdaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Tuesday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="4" name="day[]" {{$wednesdaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Wednesday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="5" name="day[]" {{$thursdaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Thursday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="6" name="day[]" {{$fridaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Friday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input dayselect" type="checkbox" value="7" name="day[]" {{$saturdaydaystatus}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Saturday
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="editalldays" {{$alldays}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            All
                        </label>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="control-label">Short Description</label>
                    limit <span class="limit">0</span>/200
                    <textarea name="description" class="form-control form-control-user" id="editdescriptionchamber" aria-describedby="description" placeholder="Enter description for Chamber..." value="" maxlength="200">{{$chamberdata->description}}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        Edit Chamber
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection