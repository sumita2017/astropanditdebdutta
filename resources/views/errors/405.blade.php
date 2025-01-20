@extends('layouts.frontlayout')
@section('content')
<!-- Begin Page Content -->
<!--BLog single section-->
<section id="blog-single" class="p-top-80 p-bottom-80 aboutcss">

    <!--Container-->
    <div class="container clearfix ">
        <div class="row p-bottom-50 ">


            <div class="col-md-4">

            </div> <!-- /.col -->
            <div class="col-md-4 d-flex justify-content-center 
                 align-items-center">

                <div class="col-md-12 text-center">
                    <h1>405</h1>
                    <h2>Method Not Allowed</h2>
                    <p>
                        Your request cannot be completed due to a server error.
                    </p>
                    <p>
                        <a id="errortohome" style="background-color: antiquewhite;" class="btn mt-30 btn-secondary btn-lg" href="{{ URL::to('/') }}">Go to <i class="icon_house_alt"></i>Home page</a>
                    </p>
                </div>

            </div> <!-- /.col -->
            <div class="col-md-4">

            </div> <!-- /.col -->

        </div> <!-- /.row -->
    </div> <!-- /.container -->

</section><!--End blog single section-->
@endsection