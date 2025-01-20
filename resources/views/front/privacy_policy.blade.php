@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 aboutcss">
    <div class="container clearfix ">
        <div class="row" style="font-size: 14pt;">
            <h1>Privacy Policy</h1>

            @php
                $firstday = date('M d, Y', strtotime("this week"));
            @endphp
            <p class="updated-date"><span>Last updated on {{$firstday}}</span></p>


            <p class="content-text"><span>This privacy policy sets out how Astro Achariya Debdutta uses and protects any
                    information that you give Astro Achariya Debdutta when you visit their website and/or agree to
                    purchase from them.</span></p>



            <p class="content-text"><span>Astro Achariya Debdutta is committed to ensuring that your privacy is
                    protected. Should we ask you to provide certain information by which you can be identified when
                    using this website, and then you can be assured that it will only be used in accordance with this
                    privacy statement.</span></p>



            <p class="content-text"><span>Astro Achariya Debdutta may change this policy from time to time by updating
                    this page. You should check this page from time to time to ensure that you adhere to these
                    changes.</span></p>


            <p class="content-text"><span><strong>We may collect the following information:</strong></span></p>

            <ul class="unorder-list">

                <li class="list-item">

                    <p class="content-text list-text"><span>Name</span></p>

                </li>

                <li class="list-item">

                    <p class="content-text list-text"><span>Contact information including email address</span></p>

                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Demographic information such as postcode, preferences and
                            interests, if required</span></p>


                </li>

                <li class="list-item">

                    <p class="content-text list-text"><span>Other information relevant to customer surveys and/or
                            offers</span></p>

                </li>

            </ul>

            <p class="content-text"><span><strong>What we do with the information we gather</strong></span></p>


            <p class="content-text"><span>We require this information to understand your needs and provide you with a
                    better service, and in particular for the following reasons:</span></p>


            <ul class="unorder-list">

                <li class="list-item">

                    <p class="content-text list-text"><span>Internal record keeping.</span></p>

                </li>

                <li class="list-item">

                    <p class="content-text list-text"><span>We may use the information to improve our products and
                            services.</span></p>

                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>We may periodically send promotional emails about new
                            products, special offers or other information which we think you may find interesting using
                            the email address which you have provided.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>From time to time, we may also use your information to
                            contact you for market research purposes. We may contact you by email, phone, fax or mail.
                            We may use the information to customise the website according to your interests.</span></p>


                </li>

            </ul>


            <p class="content-text"><span>We are committed to ensuring that your information is secure. In order to
                    prevent unauthorised access or disclosure we have put in suitable measures.</span></p>


            <p class="content-text"><span><strong>How we use cookies</strong></span></p>


            <p class="content-text"><span>A cookie is a small file which asks permission to be placed on your computer's
                    hard drive. Once you agree, the file is added and the cookie helps analyze web traffic or lets you
                    know when you visit a particular site. Cookies allow web applications to respond to you as an
                    individual. The web application can tailor its operations to your needs, likes and dislikes by
                    gathering and remembering information about your preferences.</span></p>



            <p class="content-text"><span>We use traffic log cookies to identify which pages are being used. This helps
                    us analyze data about webpage traffic and improve our website in order to tailor it to customer
                    needs. We only use this information for statistical analysis purposes and then the data is removed
                    from the system.</span></p>



            <p class="content-text"><span>Overall, cookies help us provide you with a better website, by enabling us to
                    monitor which pages you find useful and which you do not. A cookie in no way gives us access to your
                    computer or any information about you, other than the data you choose to share with us.</span></p>



            <p class="content-text"><span>You can choose to accept or decline cookies. Most web browsers automatically
                    accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.
                    This may prevent you from taking full advantage of the website.</span></p>


            <p class="content-text"><span><strong>Controlling your personal information</strong></span></p>


            <p class="content-text"><span>You may choose to restrict the collection or use of your personal information
                    in the following ways:</span></p>


            <ul class="unorder-list">

                <li class="list-item">


                    <p class="content-text list-text"><span>whenever you are asked to fill in a form on the website,
                            look for the box that you can click to indicate that you do not want the information to be
                            used by anybody for direct marketing purposes</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>if you have previously agreed to us using your personal
                            information for direct marketing purposes, you may change your mind at any time by writing
                            to or emailing us at</span></p>

                </li>

            </ul>


            <p class="content-text"><span>We will not sell, distribute or lease your personal information to third
                    parties unless we have your permission or are required by law to do so. We may use your personal
                    information to send you promotional information about third parties which we think you may find
                    interesting if you tell us that you wish this to happen.</span></p>

            <h3 class="font-sans italic font-bold text-xl">&nbsp;</h3>
        </div>
    </div>
</section><!--End blog single section-->
@endsection