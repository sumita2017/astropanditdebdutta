@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->

<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80">
    <div class=" text-center m-bottom-20">
        <h2 class="wow fadeInDown no-margin" data-wow-duration="1s" data-wow-delay="0.6s">
            <strong>Appointment is Successful</strong>
        </h2>
        <p>Thank you for your interest. Your appoinment is scheduled. Our Team will connect with you and will take care
            and guid you accordingly.</p>
        <div class="divider-center-small wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s"></div>
    </div>
    <!--Container-->
    <div class="container clearfix ">
        <div class="row p-bottom-50 p-top-80">
            <div class="col-md-12" style="text-align: center;">
                @if($allchamber != null)
                                <p>This is the chambers we have where you can have one and one consultation offline.Please contact us
                                    using the helpline number our team will guid you with every details. </p>
                                <div class=" col-md-2"></div>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($allchamber as $chamber)
                                            <!-- === Price Item 3 === -->
                                            <div class=" col-md-4 col-sm-4 p-bottom-30">
                                                <div class="" data-wow-delay="0.8s">
                                                    <div class="">
                                                        <h4> Chamber {{$i}} Details </h4>
                                                    </div>
                                                    <ul class="">
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
                                                </div>
                                            </div> <!-- /.col -->
                                            @php
                                                $i++;
                                            @endphp
                                @endforeach
                @else
                    <div class="col-md-8" style="text-align: center;">
                        <div class="feature-image parent ">
                            <h2
                                class="text-2xl md:text-3xl lg:text-4xl mt-7 font-semibold mb-4 font-philosopher text-center">
                                Book an Appointment</h2>
                            <h3>Unlock Solutions, Embrace Serenity.</h3>
                            <div>
                                <p>In years of practicing astrology, I've discovered a profound truth - every problem is a
                                    lock with a key. Whether it's delving into horoscopes, tarot, or palmistry, I provide
                                    seekers with remedies, unlocking doors to happiness and goals.</p>
                                <p>Life becomes precious, and the lessons learned are cherished for good. Find solutions,
                                    feel sorted, and embrace the journey towards a fulfilled life.</p>
                            </div>
                        </div>
                    </div> <!-- /.col -->
                @endif
            </div>
        </div> <!-- /.col -->
    </div> <!-- /.row -->

    </div> <!-- /.container -->

</section><!--End blog single section-->
@endsection