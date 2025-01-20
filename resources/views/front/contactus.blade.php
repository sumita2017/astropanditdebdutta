@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!-- Start Contact -->
<section id="contact" class="p-top-40  p-bottom-10">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Section Title -->
                <div class="section-title text-center m-bottom-20">
                    <h1 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.6s">Contact</h1>
                    <div class="divider-center-small wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s"></div>
                </div>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div>
    <div class="container">
        @php
            $about_contact = aboutalldetails();
        @endphp
        <div class="row">
            <div class="col-md-12">
                <!-- === Contact Form === -->
                <div class="col-md-7 col-sm-7 p-bottom-10">
                    <div class="contact-form">

                        <form class="user" id="contactusform" method="POST" action="{{ URL::to('addcontactus') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-6 contact-form-item wow zoomIn">
                                    <input name="fullname" id="name" type="text" placeholder="Your Name: *" required />
                                    <span class="error" id="err-name">please enter name</span>
                                </div>

                                <div class="col-md-6 contact-form-item wow zoomIn">
                                    <input name="email" id="email" type="email" placeholder="E-Mail: *" required />
                                    <span class="error" id="err-email">please enter e-mail</span>
                                    <span class="error" id="err-emailvld">e-mail is not a valid format</span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 contact-form-item wow zoomIn">
                                    <div class="input-group">
                                        <div class="input-group-addon" id="basic-addon1">+91</div>
                                        <input type="text" maxlength="10" placeholder="Phone Number: *" name="phone"
                                            aria-describedby="basic-addon1" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                                            aria-describedby="basic-addon1" required>
                                        <span class="error" id="err-phone">please enter phone number</span>
                                        <span class="error" id="err-phone">please enter numbers</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 contact-form-item wow zoomIn">
                                    <textarea name="message" id="message" placeholder="Your Message"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 contact-form-item">
                                    <button type="submit" class="btn contactsubmit roundbtn">Submit</button>
                                </div>
                            </div>
                            <div class="error errorcontact" id="err-state"></div>
                        </form>

                        <div class="clearfix"></div>
                        <div class="panel panel-default" id="ajaxsuccess">
                            <div class="panel-body">
                                Thank you for writing to us. We have received your message and will get back to you
                                within as soon as possible.
                            </div>
                        </div>
                    </div> <!-- /.contacts-form & inner row -->
                </div> <!-- /.col -->

                <!-- === Contact Information === -->
                <div class="col-md-5 col-sm-5 p-bottom-10">
                    <!-- === AchariyaDebdutta === -->
                    <div class="row m-top-10 wow slideInRight youtubesection">
                        @php
                            $youtubedp1 = $youtubechanneldata1->thumbnails->medium->url;
                            //dd($youtubechanneldata);
                            $youtubetitle1 = $youtubechanneldata1->title;
                        @endphp
                        <a href="{{ 'https://www.youtube.com/' . $youtubechanneldata1->customUrl}}">
                            <div class="col-xs-4 col-md-4 text-center">
                                <img src="{{ $youtubedp1 }}" alt="youtube" class="img-circle">
                            </div>
                            <div class="col-xs-8 col-md-8">
                                <p><i class="fa fa-youtube-play red" aria-hidden="true"></i> {{$youtubetitle1}}</p>
                                <p class="black">{{$youtubechanneldatasubscription1 / 1000}}K subscribers</p>
                            </div>
                        </a>
                    </div>

                    <!-- === TheDebduttaShow === -->
                    <div class="row m-top-10 wow slideInRight youtubesection">
                        @php
                            $youtubedp2 = $youtubechanneldata2->thumbnails->medium->url;
                            //dd($youtubechanneldata);
                            $youtubetitle2 = $youtubechanneldata2->title;
                        @endphp
                        <a href="{{ 'https://www.youtube.com/' . $youtubechanneldata2->customUrl}}">
                            <div class="col-xs-4 col-md-4 text-center">
                                <img src="{{ $youtubedp2 }}" alt="youtube" class="img-circle">
                            </div>
                            <div class="col-xs-8 col-md-8">
                                <p><i class="fa fa-youtube-play red" aria-hidden="true"></i> {{$youtubetitle2}}</p>
                                <p class="black">{{$youtubechanneldatasubscription2 / 1000}}K subscribers</p>
                            </div>
                        </a>
                    </div>

                    <!-- === AstroAchariya === -->
                    <div class="row m-top-10 wow slideInRight youtubesection">
                        @php
                            $youtubedp3 = $youtubechanneldata3->thumbnails->medium->url;
                            //dd($youtubechanneldata);
                            $youtubetitle3 = $youtubechanneldata3->title;
                        @endphp
                        <a href="{{ 'https://www.youtube.com/' . $youtubechanneldata3->customUrl}}">
                            <div class="col-xs-4 col-md-4 text-center">
                                <img src="{{ $youtubedp3 }}" alt="youtube" class="img-circle ">
                            </div>
                            <div class="col-md-8 col-xs-8">
                                <p><i class="fa fa-youtube-play red" aria-hidden="true"></i> {{$youtubetitle3}}</p>
                                <p class="black">
                                    {{$youtubechanneldatasubscription3 / 1000}}K
                                    subscribers
                                </p>
                            </div>
                        </a>
                    </div>
                </div> <!-- /.col -->
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<!-- End Contact -->
@endsection