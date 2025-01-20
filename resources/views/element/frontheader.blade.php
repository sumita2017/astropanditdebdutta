<!-- Start Navigation -->

<!-- Topbar Start -->
<div class="container-fluid bg-dark text-light px-0 py-2">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <span class="fa fa-phone-alt me-2"></span>
                @php
                    $aboutcontact = aboutalldetails();
                @endphp
                <span><a href="tel:+91 {{$aboutcontact->phone['0']}}">+91 {{$aboutcontact->phone['0']}}</a></span>
            </div>
            <!-- <div class="h-100 d-inline-flex align-items-center">
                <span class="far fa-envelope me-2"></span>
                <span>info@example.com</span>
            </div> -->
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center mx-n2">
                @php
                    $socialdata = scociallinks();
                @endphp
                @foreach ($socialdata as $social)
                    @if($social['name'] == 'Facebook')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link"><i
                                class="fab fa-facebook social fa-xl" aria-hidden="true"></i></a>
                    @elseif($social['name'] == 'Youtube')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link "><i
                                class="fab fa-youtube-play social fa-xl" aria-hidden="true"></i></a>
                    @elseif($social['name'] == 'WhatsApp')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link"><i
                                class="fab fa-whatsapp social fa-xl" aria-hidden="true"></i></a>
                    @elseif($social['name'] == 'Instagram')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link "><i
                                class="fab fa-instagram social fa-xl" aria-hidden="true"></i></a>
                    @elseif($social['name'] == 'Linkedin')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link "><i
                                class="fab fa-linkedin-square social fa-xl" aria-hidden="true"></i></a>
                    @elseif($social['name'] == 'Twitter')
                        <a href="{{$social['url']}}" title="{{$social['name']}}" target="_blank" class="btn btn-link "><i
                                class="fa-brands fa-x-twitter fa-xl" aria-hidden="true"></i></a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{ URL::to('/') }}" class="navbar-brand d-flex align-items-center px-4 ">
        <img src="{{ URL::to('admin/img/navlogo3.png') }}" alt="Feature Image" class="logo img-responsive logoimage3"
            id="logoimage3" />
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ URL::to('/') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ URL::to('/aboutus') }}" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                @php
                    $servicelistfooter = servicelistfooter();
                @endphp
                <div class="dropdown-menu bg-light m-0">
                    @foreach ($servicelistfooter as $key => $service)
                        @php    $servicename = preg_replace('/\s*/', '', $service['name']);
                        @endphp
                        <a href="{{ URL::to('service') . '/' . $service['nameurl'] }}"
                            class="dropdown-item">{{$service['name']}}</a>
                    @endforeach
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Free Calculator</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="#" class="dropdown-item">1</a>
                    <a href="#" class="dropdown-item">2 </a>
                    <a href="#" class="dropdown-item">3</a>
                    <a href="#" class="dropdown-item">4</a>
                    <a href="#" class="dropdown-item">5 </a>
                </div>
            </div>
            <a href="{{ URL::to('/appointment') }}" class="nav-item nav-link">Consultation </a>
            @if(Request::is('/'))
                <a class="nav-item nav-link" data-scroll href="#blog">Blog</a>
            @else
                <a href="{{ URL::to('/blogs') }}" class="nav-item nav-link">Blog</a>
            @endif
            <a href="{{ URL::to('/chambers') }}" class="nav-item nav-link">Chamber</a>
            @if(Request::is('/'))
                <a class="nav-item nav-link" data-scroll href="#contact">Customer Support</a>
            @else
                <a href="{{ URL::to('/contactus') }}" class="nav-item nav-link">Contact us</a>
            @endif
        </div>
        <a href="{{ URL::to('/appointment') }}" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Book an
            Appointment</a>
    </div>
</nav>
<!-- Navbar End -->