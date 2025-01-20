<!DOCTYPE html>
<html lang="en">
@php
    $fullurl = Request::url();
    $appurl = URL::to('/');

    if ($fullurl == $appurl) {

        $seodetailsperpage = seodetailsperpage('home', 'static');

    } else {

        $page = str_replace($appurl, "", $fullurl);
        $urlname = explode("/", $page);

        if (count($urlname) == 2 || count($urlname) == 1) {
            $seodetailsperpage = seodetailsperpage(end($urlname), 'static');
        } else {
            $seodetailsperpage = seodetailsperpage(end($urlname), $urlname[1]);
        }

    }
    //dd($seodetailsperpage['metadata']);
@endphp

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="{{ $seodetailsperpage['description']}}" />
    <meta name="keywords" content="{{ $seodetailsperpage['keyword']}}" />
    <meta name="author" content="Astro Achariya Debdutta|Sumita Das" />
    <!-- Title -->
    <title>{{ $seodetailsperpage['title'] }}</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::to('admin/img/llogoicon-01-01.png') }}" />

    @foreach ($seodetailsperpage['metadata'] as $metaseo)
        {!! $metaseo !!}
    @endforeach

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::to('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('frontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::to('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ URL::to('frontend/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div> -->
    <!-- Spinner End -->

    @stack('style')
    <!-- Custom CSS -->
    <!-- <link href="{{ URL::to('frontend/css/custome.css') }}" rel="stylesheet"> -->

    @include('element.frontheader')
    <!-- Start Intro -->

    <!-- Main content -->
    @yield('content')
    @include('element.frontfooter')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @php
        $aboutcontact = aboutalldetails();
    @endphp

    <a aria-label="Chat on WhatsApp" class="btn btn-lg btn-primary btn-lg-square rounded-circle whatsapp"
        href="https://wa.me/91{{$aboutcontact->whatsapp}}" id="whatsappbtn"><i class="fa-brands fa-x-twitter"></i></a>

    @include('element.frontmodal')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::to('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ URL::to('frontend/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::to('frontend/js/main.js') }}"></script>

    <!-- Custom Plugin -->
    <!-- <script src="{{ URL::to('frontend/js/custom.js') }}"></script> -->
    <!-- @stack('scripts') -->
    <!-- @include('element.frontjquery') -->
</body>



</html>