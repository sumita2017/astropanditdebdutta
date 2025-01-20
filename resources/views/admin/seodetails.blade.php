@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>

    <div class="container-fluid px-4">

        <h2 class="mt-4">
            @if ($page_name === null)
            client
            @else
            {{ $page_name }}
            @endif
        </h2>
        <!-- to show the session status message -->

        <div class="mt-5 mb-4">
            <h1>Add XML Sitemap</h1>
            @php
            $sitemap=URL::to('/').'/'.'sitemap.xml';
            @endphp
            @if (file_exists(public_path('/') . '/' . 'sitemap.xml'))
            <a href="{{ $sitemap }}" class="btn btn-primary mt-4 mb-4" target="_blank">See website's Sitemap</a>
            @endif
            @if (file_exists(public_path('/') . '/' . 'robots.txt'))
            @php
            $sitemap=URL::to('/').'/'.'robots.txt';
            @endphp
            <a href="{{ $sitemap }}" class="btn btn-primary mt-4 mb-4" target="_blank">See website's Robots.txt</a>
            @endif
            <form id="xmlform" method="post" action="{{ URL::to('xmlupload') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="file" id="formFilexml" name="sitemap" accept=".xml,.txt" required>
                    <button class="btn btn-outline-secondary" type="submit">Upload sitemap</button>
                </div>
            </form>
        </div>

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


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Seo url list
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Seo status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Page</th>
                            <th>Seo status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($seodetails as $seo1)
                        <tr>
                            @if($seo1['page'] == 'home')
                            <td><a href="{{URL::to('/') }}" target="_blank">{{URL::to('/') }}</a></td>
                            @else
                            <td><a href="{{URL::to('/')."/".$seo1['page'] }}" target="_blank">{{URL::to('/')."/".$seo1['page'] }}</a></td>
                            @endif
                            @if($seo1['status'] == 1)
                            <td><i class="fa-solid fa-circle" style="color: #097e13;"></i></td>
                            @else
                            <td><i class="fa-solid fa-circle" style="color: #fa0000;"></i></td>
                            @endif
                            <td><a href="{{URL::to('editseo').'/'.$seo1['pagetype'].'/'.$seo1['page'] }}" class="btn btn-secondary">Seo Details</a></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Services & Blogs</td>
                        </tr>
                        @foreach ($newseo as $seo)
                        <tr>
                            <td><a href="{{URL::to('/')."/".$seo['page'] }}" target="_blank">{{URL::to('/')."/".$seo['page'] }}</a></td>
                            @if($seo['status'] == 1)
                            <td><i class="fa-solid fa-circle" style="color: #097e13;"></i></td>
                            @else
                            <td><i class="fa-solid fa-circle" style="color: #fa0000;"></i></td>
                            @endif
                            <td><a href="{{URL::to('editseo').'/'.$seo['page'] }}" class="btn btn-secondary">Seo Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection