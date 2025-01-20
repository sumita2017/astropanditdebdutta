@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 aboutcss">
    <div class="container clearfix ">
        <div class="row" style="font-size: 14pt;">
            <h1>Refund Policy</h1>

            @php
            $firstday = date('M d, Y', strtotime("this week"));
            @endphp
            <p class="updated-date"><span>Last updated on {{$firstday}}</span></p>

            <p class="content-text" style="text-align: left;"><span style="font-size: 14pt;">No cancellations & Refunds are entertained.</span></p>

            <p class="content-text" style="text-align: left;"><span style="font-size: 14pt;"><strong>Refunds:</strong> We do not offer refund if you cancel your consultation appointment . If you face any technical issue your requests must be submitted in writing to us in achariyadebdutta@gmail.com within 24 hours.</span></p>
            <p class="content-text" style="text-align: left;"><span style="font-size: 14pt;"><strong>Returns:</strong> Due to the nature of astrological consultations, we do not accept returns once the consultation session has been conducted.</span></p>

            <h3 class="font-sans italic font-bold text-xl">&nbsp;</h3>

            <!-- <p class="content-text" style="text-align: left;"><span style="font-size: 14pt;">For Shipping Policy details <a href="{{ URL::to('/shipping_policy') }}">Shipping Policy</a></span></p> -->
        </div>
    </div>
</section><!--End blog single section-->
@endsection