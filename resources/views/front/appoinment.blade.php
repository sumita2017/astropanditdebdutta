@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->

<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 appoinmentcss">
    <div class="section-title-bg text-center m-bottom-20">
        <h2 class="wow fadeInDown no-margin" data-wow-duration="1s" data-wow-delay="0.6s">
            <strong>Appointment Details Form</strong>
        </h2>
        <div class="divider-center divider-theme wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s"></div>
    </div>
    <!--Container-->
    <div class="container clearfix ">
        <div class="row p-bottom-50 ">
            <div class="col-md-4 p-top-140" style="text-align: center;">
                <div class="feature-image parent appoinmentcolor">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl mt-7 font-semibold mb-4 font-philosopher text-center ">
                        Book an Appointment</h2>
                    <h3>Unlock Solutions, Embrace Serenity.</h3>
                    <div>
                        <p>In years of practicing astrology, I've discovered a profound truth - every problem is a lock
                            with a key. Whether it's delving into horoscopes, tarot, or palmistry, I provide seekers
                            with remedies, unlocking doors to happiness and goals.</p>
                        <p>Life becomes precious, and the lessons learned are cherished for good. Find solutions, feel
                            sorted, and embrace the journey towards a fulfilled life.</p>

                        <p>Kindly Fill in your Full Name, Date of Birth, Place of Birth, Time of Birth and Gender. Rest
                            assured, we do not require any other personal or sensitive details.</p>
                        <p><strong>
                                Please note that the appointment will be scheduled based on the availability of the
                                slot.</strong>
                        </p>
                        <p>Our team will contact you and guide you accordingly.</p>
                    </div>
                </div>
            </div> <!-- /.col -->

            <div class="col-md-offset-2 col-md-6">
                <!-- Section Title -->
                <div class="wow fadeInLeft" data-wow-duration="0.7s" data-wow-delay="0.5s">
                    <div class="contact-form appointmentform row">

                        <form class="user" id="appoinmentform1" method="POST" action="{{ URL::to('checkout') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-sm-12 contact-form-item wow zoomIn ">
                                <label class="darkcolorfont" for="name">Full Name*</label>
                                <input name="name" id="name" type="text" placeholder="Full Name*" required />
                                <span class="error" id="err-name">Please enter Full name</span>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="email">Email</label>
                                <input name="email" id="email" type="email" placeholder="E-Mail: *" required />
                                <span class="error" id="err-email">please enter e-mail</span>
                                <span class="error" id="err-emailvld">e-mail is not a valid format</span>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="phonenumber">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+91</span>
                                    <input type="text" maxlength="10" placeholder="Phone Number: *" name="phoneNumber"
                                        aria-describedby="basic-addon1" id="phonenumber"
                                        pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                                    <span class="error" id="err-phone">please enter phone number</span>
                                    <span class="error" id="err-emailvld">please enter numbers</span>
                                </div>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="whatsappNumber">Whatsapp Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+91</span>
                                    <input type="text" maxlength="10" placeholder="Whatsapp Number: *"
                                        name="whatsappNumber" aria-describedby="basic-addon1" id="whatsappNumber"
                                        pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                                    <span class="error" id="err-phone">please enter phone number</span>
                                    <span class="error" id="err-emailvld">please enter numbers</span>
                                </div>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont">Gender</label>
                                <div class="radio">
                                    <label class="darkcolorfont">
                                        <input type="radio" name="gender" id="optionsRadios1" value="m" checked>
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="darkcolorfont">
                                        <input type="radio" name="gender" id="optionsRadios2" value="f">
                                        Female
                                    </label>
                                </div>
                                <div class="radio ">
                                    <label class="darkcolorfont">
                                        <input type="radio" name="gender" id="optionsRadios3" value="o">
                                        Others
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="dp2">Date of Birth</label>
                                <div class="input-group">
                                    <input type="text" class="inputstyleright" id="birthdate" name="dateOfBirth"
                                        value="" />
                                    <div class="input-group-addon addonstyleright"><i
                                            class="darkcolorfont fa fa-calendar"></i></div>
                                </div>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="timepicker1">Time of Birth</label>
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input id="timepicker1" class="inputstyleright" type="text" name="timeOfBirth"
                                        required />
                                    <div class="input-group-addon addonstyleright"><i
                                            class="darkcolorfont glyphicon glyphicon-time"></i></div>
                                </div>
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="placecity">City of Birth</label>
                                <input name="placeOfBirth" id="placecity" type="text" placeholder="Kolkata" required />

                                <span class="error" id="err-name">Please enter full name</span>
                            </div>

                            <!-- <input id="autocomplete_search" name="autocomplete_search" type="text" class="form-control" placeholder="Search" /> -->

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="placestate">State of Birth</label>
                                <input name="stateOfBirth" id="placestate" type="text" placeholder="West bengal"
                                    required />
                                <span class="error" id="err-name">Please enter full name</span>
                            </div>

                            <div class="col-sm-12 contact-form-item">
                                <label class="darkcolorfont" for="booking">Consultation type</label>
                                <select class="booking appointmentType" name="appointmentType">
                                    <option disabled selected value> -- Select Consultation type -- </option>
                                    <option value="o" style="color: black;">Online Consultation</option>
                                    <option value="m" style="color: black;">Offline Consultation</option>
                                </select>
                            </div>

                            <div class="col-sm-12 contact-form-item chamberselect" style="display:none">
                                <label class="darkcolorfont">Select Chamber</label>
                                @php
$i = 0;
                                @endphp
                                @foreach ($allchamber as $chamber)
                                                                <div class="radio">
                                                                    <label class="darkcolorfont">
                                                                        @if($i == 0)
                                                                            <input type="radio" class="chamberoption" name="chamberId"
                                                                                id="chamber{{$chamber->id}}" value="{{$chamber->id}}">
                                                                            {{$chamber->locationname}}
                                                                        @else
                                                                            <input type="radio" class="chamberoption" name="chamberId"
                                                                                id="chamber{{$chamber->id}}" value="{{$chamber->id}}">
                                                                            {{$chamber->locationname}}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                                @php
    $i++;
                                                                @endphp
                                @endforeach
                            </div>

                            <div class="col-sm-12 contact-form-item wow zoomIn">
                                <label class="darkcolorfont" for="bookingdate">Booking schedule</label>
                                <div class="input-group">
                                    <input type="text" class="inputstyleright" name="bookingDate" id="bookingdate"
                                        value="" />
                                    <div class="input-group-addon addonstyleright"><i
                                            class="darkcolorfont fa fa-calendar"></i></div>
                                </div>
                                <span class="error" id="err-name">Please enter booking schedule</span>
                            </div>
                            <button type="submit" class="btn appoinmentsubmit btn-lg btn-grad" >Pay  <i class="fa fa-inr" aria-hidden="true"></i>{{ $paymentamount }}</button>
                        </form>
                    </div> <!-- /.contacts-form & inner row -->
                </div>
            </div> <!-- /.col -->

        </div> <!-- /.row -->

    </div> <!-- /.container -->
</section><!--End blog single section-->
@endsection