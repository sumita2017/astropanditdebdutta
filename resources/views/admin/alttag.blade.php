@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>

    <div class="container-fluid px-4">
        <h2 class="mt-4">
            @if ($page_name === null)
            client
            @else
            {{ $page_name}}
            @endif
        </h2>
        <!-- to show the session status message -->
        @php
        $sessiondata = session()->all();

        @endphp
        @if(session()->has('status') && session()->has('msg'))
        @if($sessiondata['status'] === '1')
        <div class="alert alert-info sessiondata" role="alert">{{ $sessiondata['msg'] }}</div>
        @else
        <div class="alert alert-danger sessiondata" role="alert">{{ $sessiondata['msg'] }}</div>
        @endif
        @php
        session()->forget(['status', 'msg']);
        @endphp
        @endif


        <!-- Page Content -->
        <div class="container">
            <nav class="nav">
                <a class="nav-link active" aria-current="page" href="{{ URL::to('alttag')}}#about" style="color: darkgoldenrod;">About Images</a>
                <a class="nav-link" href="{{ URL::to('alttag')}}#banners" style="color: darkgoldenrod;">Banner thumbnails</a>
                <a class="nav-link" href="{{ URL::to('alttag')}}#uvideos" style="color: darkgoldenrod;">Youtube Video thumbnails</a>
                <a class="nav-link" href="{{ URL::to('alttag')}}#service" style="color: darkgoldenrod;">Service</a>
                <a class="nav-link" href="{{ URL::to('alttag')}}#blog" style="color: darkgoldenrod;">Blog</a>
            </nav>
            @php
            $aboutimage = '';
            $banners = '';
            $uvideos='';
            $blog = '';
            $service = '';

            $aboutimage =$allimages['about_contact'];
            $banners =$allimages['banner'];
            $uvideos =$allimages['videos'];
            $services =$allimages['Service'];
            $blog =$allimages['blog'];

            $alttag='';
            $title=''
            @endphp

            <div class="row text-center text-lg-start" id="about">
                <h1 class="fw-light text-center text-lg-start mt-4 mb-0">About Images</h1>
                <hr class="mt-2 mb-5">
            </div>
            <div class="row text-center text-lg-start">
                <!-- section for about page image -->
                @if(!empty($aboutimage))
                @foreach($aboutimage as $aboutdata)
                @if(!empty($aboutdata['alttag']) && !empty($aboutdata['title']))
                @php
                $alttag=$aboutdata['alttag'];
                $title=$aboutdata['title'];
                @endphp
                @else
                @php
                $alttag='';
                $title='';
                @endphp
                @endif
                <div class="card" style="width: 18rem; margin: 2%;">
                    <img class="img-fluid img-thumbnail" src="{{ URL::to('about')."/".$aboutdata['image'] }}" alt="" title="">
                    <div class="card-body">

                        <p><span class="fw-bold">Title : </span>{{$title}}</p>
                        <p><span class="fw-bold">AltTag details : </span>{{$alttag}}</p>
                        <button type="button" class="btn btn-outline-secondary aboutalt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$aboutdata['page']}}" relatedid="{{$aboutdata['relatedid']}}" alttag="{{$aboutdata['alttag']}}" title="{{$aboutdata['title']}}" urlview="{{ URL::to('/aboutus') }}">
                            Edit Alt Tag and Title
                        </button>
                    </div>
                </div>
                @endforeach
                @else
                <p class="fw-medium">No image available</p>
                @endif
            </div>

            <div class="row text-center text-lg-start" id="banners">
                <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Banner Thumbnails</h1>
                <hr class="mt-2 mb-5">
            </div>
            <div class="row text-center text-lg-start">
                <!-- section for bannervideos thumbnails -->
                @if(!empty($banners))
                @foreach($banners as $bannerdata)
                @if(!empty($bannerdata['alttag']) && !empty($bannerdata['title']))
                @php
                $alttag=$bannerdata['alttag'];
                $title=$bannerdata['title'];
                @endphp
                @else
                @php
                $alttag='';
                $title='';
                @endphp
                @endif
                <div class="card" style="width: 18rem; margin: 2%;">
                    <img class="img-fluid img-thumbnail" src="{{ URL::to('bannervideo')."/".$bannerdata['image'] }}" alt="" title="" page="{{$bannerdata['page']}}" relatedid="{{$bannerdata['relatedid']}}">
                    <div class="card-body">

                        <p><span class="fw-bold">Title : </span>{{$title}}</p>
                        <p><span class="fw-bold">AltTag details : </span>{{$alttag}}</p>
                        @if($bannerdata['videolink'] != null)
                        <button type="button" class="btn btn-outline-secondary bannarsalt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$bannerdata['page']}}" relatedid=" {{$bannerdata['relatedid']}}" alttag="{{$bannerdata['alttag']}}" title="{{$bannerdata['title']}}" urlview="{{$bannerdata['videolink']}}">
                            Edit Alt Tag and Title
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-secondary bannarsalt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$bannerdata['page']}}" relatedid=" {{$bannerdata['relatedid']}}" alttag="{{$bannerdata['alttag']}}" title="{{$bannerdata['title']}}" urlview="#">
                            Edit Alt Tag and Title
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
                @else
                <p class="fw-medium">No image available</p>
                @endif
            </div>


            <div class="row text-center text-lg-start" id="uvideos">
                <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Youtube Video Thumbnails</h1>
                <hr class="mt-2 mb-5">
            </div>
            <div class="row text-center text-lg-start">
                <!-- section for bannervideos thumbnails -->
                @if(!empty($uvideos))
                @foreach($uvideos as $uvideosdata)
                @if(!empty($uvideosdata['alttag']) && !empty($uvideosdata['title']))
                @php
                $alttag=$uvideosdata['alttag'];
                $title=$uvideosdata['title'];
                @endphp
                @else
                @php
                $alttag='';
                $title='';
                @endphp
                @endif
                <div class="card" style="width: 18rem; margin: 2%;">
                    <img class="img-fluid img-thumbnail" src="{{ URL::to('bannervideo')."/".$uvideosdata['image'] }}" alt="" title="" page="{{$uvideosdata['page']}}" relatedid="{{$uvideosdata['relatedid']}}">
                    <div class="card-body">

                        <p><span class="fw-bold">Title : </span>{{$title}}</p>
                        <p><span class="fw-bold">AltTag details : </span>{{$alttag}}</p>

                        <button type="button" class="btn btn-outline-secondary bannarsalt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$uvideosdata['page']}}" relatedid=" {{$uvideosdata['relatedid']}}" alttag="{{$uvideosdata['alttag']}}" title="{{$uvideosdata['title']}}" urlview="{{$uvideosdata['videolink']}}">
                            Edit Alt Tag and Title
                        </button>
                    </div>
                </div>
                @endforeach
                @else
                <p class="fw-medium">No image available</p>
                @endif
            </div>

            <div class=" row text-center text-lg-start" id="service">
                <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Service Images</h1>
                <hr class="mt-2 mb-5">
            </div>
            <div class="row text-center text-lg-start">
                <!-- section for service images -->
                @if(!empty($services))
                @foreach($services as $servicedata)
                @if(!empty($servicedata['alttag']) && !empty($servicedata['title']))
                @php
                $alttag=$servicedata['alttag'];
                $title=$servicedata['title'];
                @endphp
                @else
                @php
                $alttag='';
                $title='';
                @endphp
                @endif
                <div class="card" style="width: 18rem; margin: 2%;">
                    <img class="img-fluid img-thumbnail" src="{{ URL::to('service')."/".$servicedata['image'] }}" alt="" title="" page="{{$servicedata['page']}}" relatedid="{{$servicedata['relatedid']}}">
                    <div class="card-body">

                        <p><span class="fw-bold">Title : </span>{{$title}}</p>
                        <p><span class="fw-bold">AltTag details : </span>{{$alttag}}</p>
                        <button type="button" class="btn btn-outline-secondary servicealt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$servicedata['page']}}" relatedid="{{$servicedata['relatedid']}}" alttag="{{$servicedata['alttag']}}" title="{{$servicedata['title']}}" urlview="{{ URL::to('service').'/'.$servicedata['nameurl'] }}">
                            Edit Alt Tag and Title
                        </button>
                    </div>
                </div>
                @endforeach
                @else
                <p class="fw-medium">No image available</p>
                @endif
            </div>

            <div class=" row text-center text-lg-start" id="blog">
                <h1 class="fw-light text-center text-lg-start mt-4 mb-0">Blog Images</h1>
                <hr class="mt-2 mb-5">
            </div>
            <div class="row text-center text-lg-start">
                <!-- section for blogs images -->
                @if(!empty($blog))
                @foreach($blog as $blogdata)
                @if(!empty($blogdata['alttag']) && !empty($blogdata['title']))
                @php
                $alttag=$blogdata['alttag'];
                $title=$blogdata['title'];
                @endphp
                @else
                @php
                $alttag='';
                $title='';
                @endphp
                @endif
                <div class="card" style="width: 18rem; margin: 2%;">
                    <img class="img-fluid img-thumbnail" src="{{ URL::to('blog')."/".$blogdata['image'] }}" alt="" title="">
                    <div class="card-body">

                        <p><span class="fw-bold">Title : </span>{{$title}}</p>
                        <p><span class="fw-bold">AltTag details : </span>{{$alttag}}</p>

                        <button type="button" class="btn btn-outline-secondary blogalt" data-bs-toggle="modal" data-bs-target="#addalttag" page="{{$blogdata['page']}}" relatedid="{{$blogdata['relatedid']}}" alttag="{{$blogdata['alttag']}}" title="{{$blogdata['title']}}" urlview="{{ URL::to('/blog').'/'.$blogdata['nameurl'] }}">
                            Edit Alt Tag and Title
                        </button>
                    </div>
                </div>
                @endforeach
                @else
                <p class="fw-medium">No image available</p>
                @endif
            </div>
        </div>
        <ol class=" breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection