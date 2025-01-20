@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 aboutcss">
    <div class="container clearfix ">
        <div class="row" style="font-size: 14pt;">
            <h1>Shipping Policy</h1>

            @php
            $firstday = date('M d, Y', strtotime("this week"));
            @endphp
            <p class="updated-date"><span>Last updated on {{$firstday}}</span></p>


            <p class="content-text" style="text-align: left;"><span style="font-size: 14pt;">Shipping is not applicable for this business.</span></p>

            <h3 class="font-sans italic font-bold text-xl">&nbsp;</h3>
        </div>
    </div>
</section><!--End blog single section-->
@endsection