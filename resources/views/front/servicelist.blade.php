@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--SERVICE LIST section-->
<section id="service" class="p-top-20 p-bottom-10">
    @php
$alttagforimages = alttagforimages();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title text-center m-bottom-10">
                    <h1 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s">Services</h1>
                    <p class="section-subtitle wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">My mission
                        is to kindle hope in humanity, offering the keys to solving life's puzzles through
                        {{ $allservices}}. These ancient sciences, when understood and applied, unlock abundance for
                        all.
                    </p>
                </div>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div>
    <div class="container">
        <div class="row">
            @foreach ($servicedata as $servicekey => $services)
                        <!-- === Team Item 1 === -->
                        <div class="col-md-3 col-xs-6 p-10">
                            <div class="team-item wow zoomIn" data-wow-duration="1s" data-wow-delay="0.9s">
                                <div class="team-item-name">
                                    {{$services->name}}
                                </div>
                                <div class="team-item-image">
                                    @php
    $alttag = $alttagforimages['Service'][$services->id]['alttag'];
    $title = $alttagforimages['Service'][$services->id]['title'];
                                    @endphp
                                    <a href="{{ URL::to('service') . '/' . $services->nameurl }}">
                                        <img class="img-circle" src="{{ URL::to('service') . '/' . $services->Image }}"
                                            alt="{{$alttag}}" title="{{ $title }}" />
                                    </a>
                                </div>
                                <div class="team-item-info">
                                    <a href="{{ URL::to('service') . '/' . $services->nameurl }}">
                                        <div class="team-item-position p-10">
                                            {!! html_entity_decode($services->shortdescription)!!}
                                        </div>
                                        <a href="{{ URL::to('service') . '/' . $services->nameurl }}"
                                            class="m-top-10 m-bottom-10 btn btn-service roundbtn wow fadeInUp"
                                            data-wow-duration="0.7s" data-wow-delay="0.5s">Get Started</a>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- /.col -->
            @endforeach
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

@endsection