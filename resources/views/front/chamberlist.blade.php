@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<!-- Start Price -->
<section id="price" class="p-top-80 p-bottom-50">
    <div class="container">
        <div class="row chamberlist">

            <!-- Section Title -->
            <div class="section-title text-center m-bottom-40">
                <h2 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s">Chamber</h2>
                <div class="divider-center-small wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s"></div>
            </div>
            @php
                $i = 1;
            @endphp
            @foreach ($chamberdata as $chamber)
                        @if($i == 1 || $i % 2 == 1)
                            <div class="col-md-2 col-sm-2 p-bottom-30 " style="height: 330px;"></div>
                        @endif
                        <!-- === Price Item 3 === -->
                        <div class="col-md-4 col-sm-4 p-bottom-30">
                            <div class="price-item text-center wow flipInX" data-wow-delay="0.8s">
                                <div class="price-item-header price-item-header-alt">
                                    <h4> Chamber {{$i}} Details </h4>
                                </div>
                                <ul class="price-item-features list-unstyled" style="height: 330px;">
                                    <li>
                                        <h5>Location :</h5> {{ $chamber->locationname}}
                                    </li>
                                    <li>
                                        <h5>Available Days :</h5> {{ $chamber->availabledays}}
                                    </li>
                                    <li>
                                        <h5>Help Line Phone Number :</h5> {{ $chamber->description}}
                                    </li>
                                </ul>
                                <a href="{{ URL::to('/appointment') }}" class="btn btn-main btn-theme">Book Now</a>
                            </div>
                        </div> <!-- /.col -->
                        @if($i % 2 == 0)
                            @if($i != 1)
                                <div class="col-md-2 col-sm-2 p-bottom-30" style="height: 330px;"></div>
                            @endif
                        @endif
                        @php
                            $i++;
                        @endphp

            @endforeach

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<!-- End Price -->
@endsection