@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4"><a href="{{ URL::to('seodetails') }}">Seo details page</a> / Edit Seo Details</h2>
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
        <div class="row">
            @if($seodata['pagetype'] == "static")
                @if($seodata['page'] == 'home')
                    <h3 class="mb-3"><a href="{{URL::to('/')}}" target="_blank">{{URL::to('/')}}</a></h3>
                @else
                    <h3 class="mb-3"><a href="{{URL::to('/') . '/' . $seodata['page']}}"
                            target="_blank">{{URL::to('/') . '/' . $seodata['page']}}</a></h3>
                @endif
            @else
                <h3 class="mb-3"><a href="{{URL::to('/') . '/' . $seodata['pagetype'] . '/' . $seodata['page']}}"
                        target="_blank">{{URL::to('/') . '/' . $seodata['pagetype'] . '/' . $seodata['page']}}</a></h3>
            @endif

            <form method="POST" action="{{ URL::to('updateseo') }}">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Title</label>
                    <input type="text" class="form-control code" name="title" value="{{$seodata['title']}}"
                        id="exampleFormControlInput3">
                </div>

                <input type="hidden" value="{{$seodata['page']}}" name="page">
                <input type="hidden" value="{{$seodata['relatedid']}}" name="relatedid">
                <input type="hidden" value="{{$seodata['pagetype']}}" name="pagetype">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Keywords</label>
                    <input type="text" class="form-control code" value="{{$seodata['keywords']}}" name="keyword"
                        id="exampleFormControlInput1">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Description</label>
                    <textarea type="text" class="form-control code" name="description"
                        id="exampleFormControlInput2">{{$seodata['description']}}</textarea>
                </div>

                <h3 class="mt-10">Seo metadata Or script</h3>
                <p class="fw-lighter">Please enter the data with meta tag or script tag</p>
                @if(count($seodata['metadata']) == 0)
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-code"></i></span>
                        <textarea type="text" id="metadata" class="form-control form-control-user code" name="metadata[]"
                            placeholder='<meta property="og:url" content="https://astroachariyadebdutta.com/" />'
                            required /></textarea>
                        <span class="input-group-text" id="seotext"><i class="fa-solid fa-plus"></i></span>
                    </div>
                @else
                                @php
                                    $seometacount = count($seodata['metadata']);
                                @endphp
                                @foreach ($seodata['metadata'] as $key => $metadata)
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-code"></i></span>
                                        <textarea type="text" id="metadata" class="form-control form-control-user code" name="metadata[]"
                                            required />{{$metadata}}</textarea>

                                        @if($key + 1 == $seometacount)
                                            <span class="input-group-text" id="seotext"><i class="fa-solid fa-plus"></i></span>
                                        @else
                                            <spann class="input-group-text seominus"><i class="fa-solid fa-minus"></i></spann>
                                        @endif
                                    </div>
                                @endforeach
                @endif

                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" class="btn btn-secondary btn-user btn-block">
                        Upadate Seo
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection