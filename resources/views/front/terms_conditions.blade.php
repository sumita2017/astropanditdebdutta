@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 aboutcss">
    <div class="container clearfix ">
        <div class="row" style="font-size: 14pt;">
            <h1>Terms & Condition</h1>

            @php
                $firstday = date('M d, Y', strtotime("this week"));
            @endphp
            <p class="updated-date"><span>Last updated on {{$firstday}}</span></p>


            <p class="content-text"><span>For the purpose of these Terms and Conditions, The term "we", "us", "our" used
                    anywhere on this page shall mean "Achariya Debdutta". "you",
                    &ldquo;your&rdquo;, "user", &ldquo;visitor&rdquo; shall mean any natural or legal person who is
                    visiting our website and/or agreed to purchase from us.</span></p>



            <p class="content-text"><span><strong>Your use of the website and/or purchase from us are governed by
                        following Terms and Conditions:</strong></span></p>


            <ul class="unorder-list">

                <li class="list-item">

                    <p class="content-text list-text"><span>The content of the pages of this website is subject to
                            change without notice.</span></p>

                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Neither we nor any third parties provide any warranty or
                            guarantee as to the accuracy, timeliness, performance, completeness or suitability of the
                            information and materials found or offered on this website for any particular purpose. You
                            acknowledge that such information and materials may contain inaccuracies or errors and we
                            expressly exclude liability for any such inaccuracies or errors to the fullest extent
                            permitted by law.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Your use of any information or materials on our website
                            and/or product pages is entirely at your own risk, for which we shall not be liable. It
                            shall be your own responsibility to ensure that any products, services or information
                            available through our website and/or product pages meet your specific requirements.</span>
                    </p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Our website contains material which is owned by or licensed
                            to us. This material includes, but are not limited to, the design, layout, look, appearance
                            and graphics. Reproduction is prohibited other than in accordance with the copyright notice,
                            which forms part of these terms and conditions.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>All trademarks reproduced in our website which are not the
                            property of, or licensed to, the operator are acknowledged on the website.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Unauthorized use of information provided by us shall give
                            rise to a claim for damages and/or be a criminal offense.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>From time to time our website may also include links to
                            other websites. These links are provided for your convenience to provide further
                            information.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>You may not create a link to our website from another
                            website or document without Achariya Debdutta&rsquo;s prior written consent.</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>Any dispute arising out of use of our website and/or
                            purchase with us and/or any engagement with us is subject to the laws of India .</span></p>


                </li>

                <li class="list-item">


                    <p class="content-text list-text"><span>We, shall be under no liability whatsoever in respect of any
                            loss or damage arising directly or indirectly out of the decline of authorization for any
                            Transaction, on Account of the Cardholder having exceeded the preset limit mutually agreed
                            by us with our acquiring bank from time to time</span></p>


                </li>

            </ul>

            <h3 class="font-sans italic font-bold text-xl">&nbsp;</h3>
        </div>
    </div>
</section><!--End blog single section-->
@endsection