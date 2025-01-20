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

        <div class="card mb-4">
            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#addblog">Add new
                Blog</button>
        </div>

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


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Blogs
            </div>
            <div class="card-body">

                @if(count($blogsdata) === 0)
                    <h5>No Blogs are added</h5>
                @else
                        <table id="datatablesSimple" class="servicetable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Tags</th>
                                    <th>Category</th>
                                    <th>Keyword</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Tags</th>
                                    <th>Category</th>
                                    <th>Keyword</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if(isset($blogsdata['English']) && count($blogsdata['English']) != 0)
                                                @foreach ($blogsdata['English'] as $data)
                                                                <tr>
                                                                    <td>{{ $data['title'] }}</td>

                                                                    <td>
                                                                        <div class="text-center">
                                                                            @if($data['image'] != null)
                                                                                <img src="{{ URL::to('blog') . "/" . $data['image'] }}" class="rounded  img-fluid"
                                                                                    alt="..." hight=200px width=200px>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    @php
                                                                        $small = substr(strip_tags($data['description']), 0, 200);
                                                                    @endphp

                                                                    <td>
                                                                        <p>{!!$small!!}</p>

                                                                        <a class="more" msg="{{html_entity_decode($data['description'])}}">
                                                                            ...more
                                                                        </a>
                                                                    </td>
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($data['tag'] as $tag)
                                                                            <span class="badge rounded-pill text-bg-secondary">{{$tag}}</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['category'] as $category)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$category}}</span>
                                                                    @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['keyword'] as $keyword)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$keyword}}</span>
                                                                    @endforeach
                                                                    </td>

                                                                    <td>
                                                                        <a style="font-size: medium;" title="Edit Blog" class="btn btn-warning"
                                                                            href="{{ URL::to('editblog/' . base64_encode($data['id'])) }}"><i
                                                                                class="fas fa-edit" style="color:#848795;"></i></a>

                                                                        <a title="Delete Blogs" class="btn btn-danger deleteblog"
                                                                            blogid="{{ base64_encode($data['id'])}}" blogimage="{{$data['image']}}"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                @endforeach
                                @endif
                                @if(isset($blogsdata['Bengali']) && count($blogsdata['Bengali']) != 0)
                                                @foreach ($blogsdata['Bengali'] as $data)
                                                                <tr>
                                                                    <td>{{ $data['title'] }}</td>

                                                                    <td>
                                                                        <div class="text-center">
                                                                            @if($data['image'] != null)
                                                                                <img src="{{ URL::to('blog') . "/" . $data['image'] }}" class="rounded  img-fluid"
                                                                                    alt="..." hight=200px width=200px>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    @php
                                                                        $small = substr(strip_tags($data['description']), 0, 200);
                                                                    @endphp

                                                                    <td>
                                                                        <p>{!!$small!!}</p>

                                                                        <a class="more" msg="{{html_entity_decode($data['description'])}}">
                                                                            ...more
                                                                        </a>
                                                                    </td>
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($data['tag'] as $tag)
                                                                            <span class="badge rounded-pill text-bg-secondary">{{$tag}}</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['category'] as $category)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$category}}</span>
                                                                    @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['keyword'] as $keyword)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$keyword}}</span>
                                                                    @endforeach
                                                                    </td>

                                                                    <td>
                                                                        <a style="font-size: medium;" title="Edit Blog" class="btn btn-warning"
                                                                            href="{{ URL::to('editblog/' . base64_encode($data['id'])) }}"><i
                                                                                class="fas fa-edit" style="color:#848795;"></i></a>

                                                                        <a title="Delete Blogs" class="btn btn-danger deleteblog"
                                                                            blogid="{{ base64_encode($data['id'])}}" blogimage="{{$data['image']}}"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                @endforeach
                                @endif
                                @if(isset($blogsdata['Hindi']) && count($blogsdata['Hindi']) != 0)
                                                @foreach ($blogsdata['Hindi'] as $data)
                                                                <tr>
                                                                    <td>{{ $data['title'] }}</td>

                                                                    <td>
                                                                        <div class="text-center">
                                                                            @if($data['image'] != null)
                                                                                <img src="{{ URL::to('blog') . "/" . $data['image'] }}" class="rounded  img-fluid"
                                                                                    alt="..." hight=200px width=200px>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    @php
                                                                        $small = substr(strip_tags($data['description']), 0, 200);
                                                                    @endphp

                                                                    <td>
                                                                        <p>{!!$small!!}</p>

                                                                        <a class="more" msg="{{html_entity_decode($data['description'])}}">
                                                                            ...more
                                                                        </a>
                                                                    </td>
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($data['tag'] as $tag)
                                                                            <span class="badge rounded-pill text-bg-secondary">{{$tag}}</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['category'] as $category)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$category}}</span>
                                                                    @endforeach
                                                                    </td>
                                                                    <td>@foreach ($data['keyword'] as $keyword)
                                                                        <span class="badge rounded-pill text-bg-secondary">{{$keyword}}</span>
                                                                    @endforeach
                                                                    </td>

                                                                    <td>
                                                                        <a style="font-size: medium;" title="Edit Blog" class="btn btn-warning"
                                                                            href="{{ URL::to('editblog/' . base64_encode($data['id'])) }}"><i
                                                                                class="fas fa-edit" style="color:#848795;"></i></a>

                                                                        <a title="Delete Blogs" class="btn btn-danger deleteblog"
                                                                            blogid="{{ base64_encode($data['id'])}}" blogimage="{{$data['image']}}"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                @endforeach
                                @endif
                            </tbody>
                        </table>
                @endif
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection