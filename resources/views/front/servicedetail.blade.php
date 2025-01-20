@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-30 p-bottom-20 servicecss">

    <!--Container-->
    <div class="container clearfix ">
        <div class="row " style="text-align: center; ">
            <div class="col-md-12">
                <h1 style="color:#483120;"><u>{{$servicedata->name}}</u></h1>
            </div>
        </div>
        @php
$alttagforimages = alttagforimages();
$alttag = $alttagforimages['Service'][$servicedata->id]['alttag'];
$title = $alttagforimages['Service'][$servicedata->id]['title'];
        @endphp

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="row">
                    <div class="feature-image">
                        <img src="{{ URL::to('service/' . $servicedata->Image) }}" alt="{{$alttag}}" title="{{$title}}"
                            class="img-responsive wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.6s" />
                    </div>
                    </div>
                    <div class="row">
                        <a href="{{ URL::to('/appointment') }}" class="m-top-30 m-bottom-30 btn btn-main wow fadeInUp" data-wow-duration="0.7s"
                            data-wow-delay="0.5s">Book an Appointment</a>
                    </div>

                </div> <!-- /.col -->

                <!-- Section Title -->
                <div class="col-md-8">
                    <div class="wow fadeInLeft" data-wow-duration="0.7s" data-wow-delay="0.5s">
                        {!! html_entity_decode($servicedata->description)!!}
                    </div>
                </div>
            </div> <!-- /.col -->
        </div>
    </div> <!-- /.container -->

</section><!--End blog single section-->
@endsection