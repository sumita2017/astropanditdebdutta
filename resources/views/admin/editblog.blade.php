@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Blogs</h2>
        <div class="row">
            @php

                $blogfilters = blogfilters();
                $categorydata = $blogfilters['allcategory'];
                $tagsdata = $blogfilters['alltag'];
                $keyworddata = $blogfilters['allkeyword'];

            @endphp

            <form class="user" id="formdatablogedit" method="POST" action="{{ URL::to('updateblog') }}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="mt-4">
                    <label class="control-label">Language</label>
                    <select name="language" class="form-select" aria-label="Select language" required>
                        <option selected>Select language</option>
                        @if($blogsdata->language === 'English')
                            <option value="English" selected>English</option>
                        @else
                            <option value="English">English</option>
                        @endif

                        @if($blogsdata->language === 'Bengali')
                            <option value="Bengali" selected>Bengali</option>
                        @else
                            <option value="Bengali">Bengali</option>
                        @endif

                        @if($blogsdata->language === 'Hindi')
                            <option value="Hindi" selected>Hindi</option>
                        @else
                            <option value="Hindi">Hindi</option>
                        @endif
                    </select>
                </div>

                <div class="mt-4">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control form-control-user" placeholder="Daily Panchang" name="name"
                        value="{{$blogsdata->title}}" required autofocus>
                    <input type="hidden" name="id" value="{{$blogsdata->id}}">
                </div>

                <div class="mt-4">
                    <label class="control-label">Slug or Url</label>
                    <input type="text" class="form-control form-control-user" placeholder="Daily Panchang"
                        name="nameurl" value="{{$blogsdata->nameurl}}" required autofocus>
                    <input type="hidden" name="id" value="{{$blogsdata->id}}">
                </div>

                <div class="mt-4">
                    <img src="{{ URL::to('blog') . "/" . $blogsdata->image }}" class="rounded img-fluid" id="showimage"
                        alt="no old image" hight=10% width=10%>
                </div>

                <div class="mt-4">
                    <label>Upload Image</label>
                    <input type="hidden" name="oldimage" value="{{$blogsdata->image}}">

                    <input type="file" class="form-control newimage" name="newimage" id="fileToUpload11"
                        accept="image/png, image/gif, image/jpeg, image/jpg">

                </div>

                <div class="mt-4">
                    <label class="control-label">Description</label>
                    limit <span class="limit">0</span>/2000
                    <textarea name="blogdescription" class="form-control form-control-user" id="blogdefault"
                        aria-describedby="description5"
                        placeholder="Enter blog description...">{!! html_entity_decode($blogsdata->description) !!}</textarea>
                </div>
                @php
                    $blogtags = explode(',', $blogsdata->tags);
                    $blogkeywords = explode(',', $blogsdata->keyword);
                    $blogcategories = explode(',', $blogsdata->category);
                @endphp
                <div class="row">
                    <div style="width: 40%;">
                        <label>Tags</label>
                        <select name="tags[]" data-placeholder="Choose Tags......" class="chosen-select" multiple
                            tabindex="4">
                            <option value=""></option>
                            @if(isset($tagsdata))
                                @foreach ($tagsdata as $key => $tags)
                                    @if (in_array($key, $blogtags))
                                        <option value="{{$tags}}" selected>{{$tags}} </option>
                                    @else
                                        <option value="{{$tags}}">{{$tags}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div style="width: 60%;">
                        <label>New Tags</label>
                        <lable style="font-size:12px;">(enter "," between two Category )</lable>
                        <input type="text" class="form-control form-control-user" placeholder="New Tags" name="newtags"
                            multiple value="">
                    </div>
                </div>

                <div class="row">
                    <div style="width: 40%;">
                        <label>Category</label>
                        <select data-placeholder="Choose Categories..." class="chosen-select" multiple tabindex="4"
                            name="category[]">
                            <option value=""></option>
                            @if(isset($categorydata))
                                @foreach ($categorydata as $key => $category)
                                    @if (in_array($key, $blogcategories))
                                        <option value="{{$category}}" selected>{{$category}} </option>
                                    @else
                                        <option value="{{$category}}">{{$category}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div style="width: 60%;">
                        <label>New Category</label>
                        <lable style="font-size:12px;">(enter "," between two Category )</lable>
                        <input type="text" class="form-control form-control-user" placeholder="New Category"
                            name="newcategory" multiple value="">
                    </div>
                </div>

                <div class="row">
                    <div style="width: 40%;">
                        <label>Keywords</label>
                        <select name="keyword[]" data-placeholder="Choose Categories..." class="chosen-select" multiple
                            tabindex="4">
                            <option value=""></option>
                            @if(isset($keyworddata))
                                @foreach ($keyworddata as $key => $keywords)
                                    @if (in_array($key, $blogkeywords))
                                        <option value="{{$keywords}}" selected>{{$keywords}} </option>
                                    @else
                                        <option value="{{$keywords}}">{{$keywords}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div style="width: 60%;">
                        <label>New Keywords</label>
                        <lable style="font-size:12px;">(enter "," between two Category )</lable>
                        <input type="text" class="form-control form-control-user" placeholder="New Keywords"
                            name="newkeyword" multiple value="">
                    </div>
                </div>
                <a href="{{ URL::to('deletetagskeyword').'/भोलू">delete</a>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        Update Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection