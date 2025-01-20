<!-- model for admin user add in database -->

<div class="modal fade" id="addadminuser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Admin</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="{{ URL::to('registeradmin') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="form-control form-control-solid" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <input type="hidden" name="madeby" value="1">

                        <div class="mb-4">
                            <label for="exampleFormControlSelect1">User type</label><select
                                class="form-control form-control-solid" name="usertype" id="exampleFormControlSelect1">
                                <option value="0">Master Admin</option>
                                <option value="1">Sub Admin</option>
                                <option value="2">Seo management</option>
                                <option value="4">Appointment Management</option>
                                <option value="5">Blog Management</option>
                            </select>
                        </div>

                        <!-- Email Address  -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control form-control-solid" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password  -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control form-control-solid" type="password"
                                name="password" maxlength="10" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password  -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control form-control-solid"
                                type="password" name="password_confirmation" maxlength="10" required
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button class="ms-4 btn btn-primary">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>


<!-- model for service add in database -->

<div class="modal fade" id="addservice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Service</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdata" method="POST" action="{{ URL::to('addservice') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="mt-4">
                            <label class="control-label">Service Name</label>
                            <input type="text" class="form-control form-control-user" placeholder="Service Name"
                                name="name" value="" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Short Description</label>
                            limit <span class="limit">0</span>/200
                            <textarea name="shortdescription" class="form-control form-control-user"
                                id="addshortdescription" aria-describedby="shortdescription"
                                placeholder="Enter Short Service description for Home page..." value=""
                                maxlength="200"></textarea>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Description</label>
                            limit <span class="limit">0</span>/2000
                            <textarea name="description" class="form-control form-control-user" id="adddescription"
                                aria-describedby="description5" placeholder="Enter Service description..." value=""
                                maxlength="2000" rows="10" cols="50"></textarea>
                        </div>

                        <div class="mt-4">
                            <label>Upload Service Image</label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required=""
                                accept="image/png, image/gif, image/jpeg, image/jpg" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Add Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- model for Chamber add in database -->

<div class="modal fade" id="addchamber" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Chamber</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdata2" method="POST" action="{{ URL::to('addchamber') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="mt-4">
                            <label class="control-label">Chamber Location</label>
                            <input type="text" class="form-control form-control-user" placeholder="........" name="name"
                                value="" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Available Days</label>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="1" name="day[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sunday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="2" name="day[]"
                                    checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Monday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="3" name="day[]">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Tuesday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="4" name="day[]">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Wednesday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="5" name="day[]">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Thursday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="6" name="day[]">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Friday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input dayselect" type="checkbox" value="7" name="day[]">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Saturday
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="0" id="alldays">
                                <label class="form-check-label" for="flexCheckChecked">
                                    All
                                </label>
                            </div>
                        </div>


                        <div class="mt-4">
                            <label class="control-label">Short Description</label>
                            limit <span class="limit">0</span>/200
                            <textarea name="description" class="form-control form-control-user" id="descriptionchamber"
                                aria-describedby="description" placeholder="Enter description for Chamber..." value=""
                                maxlength="200"></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Add Chamber
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- model for Banner and video add in database -->
<div class="modal fade" id="addbannervideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Banner or Video</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdata6" method="POST" action="{{ URL::to('addbannervideo') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="mt-4">
                            <label>Upload Thumbnail Image</label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload2" required=""
                                accept="image/png, image/gif, image/jpeg, image/jpg" required>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Video link </label>
                            <input type="url" pattern="https://.*" class="form-control form-control-user"
                                placeholder="https://www.youtube.com/watch?v=tZJeArQpsrI" name="videolink" value=""
                                autofocus>
                        </div>

                        <div class="mt-4 bannertextsection">
                            <label class="control-label">File Type</label>

                            <div class="form-check">
                                <input class="form-check-input filetypebannervideo" type="radio" name="thumbnailtype"
                                    id="flexRadioDefault1" value="0">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Banner
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input filetypebannervideo" type="radio" name="thumbnailtype"
                                    id="flexRadioDefault2" value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Video panel
                                </label>
                            </div>
                        </div>

                        <div class="mt-4 bannertextshow" style="display: none;" maxlength="50">
                            <label class="control-label">Banner Text </label>
                            <textarea class="form-control form-control-user" id="textareabanner"
                                name="bannertext"></textarea>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">File Visibility</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="show" id="flexRadioDefault4"
                                    value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Show
                                </label>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="show" id="flexRadioDefault3" value="0">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Hide
                            </label>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Add Banner or Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>


<!-- modal for social media link -->
<div class="modal fade" id="addsociallink" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Social Link</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdata8" method="POST" action="{{ URL::to('addsociallink') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="mt-4">
                            <label class="control-label">Social Platform Name</label>
                            <input type="text" class="form-control form-control-user" placeholder="Youtube" name="name"
                                value="" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">URL of the Platform </label>
                            <input type="url" pattern="https://.*" class="form-control form-control-user"
                                placeholder="https://www.youtube.com/@AchariyaDebdutta" name="url" value="">
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Social Platform Icon</label>
                            <input type="text" class="form-control form-control-user"
                                placeholder='<i class=" fa-brands fa-youtube"></i>' name="icon" value="" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Add Social Platform
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- modal for blog add -->

<div class="modal fade" id="addblog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Blog</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdatablog" method="POST" action="{{ URL::to('addblog') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mt-4">
                            <label class="control-label">Language</label>
                            <select name="language" class="form-select" aria-label="Select language" required>
                                <option value="1" selected>Select language</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Bengali">Bengali</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control form-control-user" placeholder="Daily Panchang"
                                name="name" value="" required autofocus>
                        </div>
                        <div class="mt-4">
                            <label class="control-label">Slug or Url</label>
                            <input type="text" class="form-control form-control-user" placeholder="daily-panchang"
                                name="nameurl" value="" required autofocus>
                        </div>

                        <div class="mt-4">
                            <label>Upload Image</label>
                            <input type="file" class="form-control" name="image" id="fileToUpload9"
                                accept="image/png, image/gif, image/jpeg, image/jpg">
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Description</label>
                            limit <span class="limit">0</span>/2000
                            <textarea name="blogdescription" class="form-control form-control-user" id="default"
                                aria-describedby="description5" placeholder="Enter blog description..."
                                value=""></textarea>
                        </div>
                        @php

                            $blogfilters = blogfilters();
                            $categorydata = $blogfilters['allcategory'];
                            $tagsdata = $blogfilters['alltag'];
                            $keyworddata = $blogfilters['allkeyword'];

                         @endphp

                        <div class="row g-3">
                            <div style="width: 40%;">
                                <label>Tags</label>
                                <select name="tags[]" data-placeholder="Choose Tags..." class="chosen-select" multiple
                                    tabindex="4">
                                    <option value=""></option>
                                    @if(isset($tagsdata))
                                        @foreach ($tagsdata as $tags)
                                            <option value="{{$tags}}">{{$tags}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div style="width: 60%;">
                                <label>New Tags</label>
                                <lable style="font-size:12px;">(enter "," between two Tags )</lable>
                                <input type="text" class="form-control form-control-user" placeholder="New Tags"
                                    name="newtags" multiple value="">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div style="width: 40%;">
                                <label>Category</label>
                                <select data-placeholder="Choose Categories..." class="chosen-select" multiple
                                    tabindex="4" name="category[]">
                                    <option value=""></option>
                                    @if(isset($categorydata))
                                        @foreach ($categorydata as $categorys)
                                            <option value="{{$categorys}}">{{$categorys}}</option>
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

                        <div class="row g-3">
                            <div style="width: 40%;">
                                <label>Keywords</label>
                                <select name="keyword[]" data-placeholder="Choose Keywords..." class="chosen-select"
                                    multiple tabindex="4">
                                    <option value=""></option>
                                    @if(isset($keyworddata))
                                        @foreach ($keyworddata as $keywords)
                                            <option value="{{$keywords}}">{{$keywords}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div style="width: 60%;">
                                <label>New Keywords</label>
                                <lable style="font-size:12px;">(enter "," between two Keywords )</lable>
                                <input type="text" class="form-control form-control-user" placeholder="New Keywords"
                                    name="newkeyword" multiple value="">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Add Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- modal for edit about us -->
<div class="modal fade" id="editaboutus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit About Us</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdataabout" method="POST" action="{{ URL::to('updateaboutus') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @php
                            $abouttitle = "";
                            $aboutdescription = "";
                            $abouthomedescription = "";
                            $aboutimage = "";
                            $aboutid = "";
                            if (isset($aboutcontactus)) {
                                $title = html_entity_decode($aboutcontactus->title);
                                if (isset($title)) {
                                    $abouttitle = $title;
                                } else {
                                    $abouttitle = "";
                                }

                                $homedescription = html_entity_decode($aboutcontactus->homedescription);
                                if (isset($homedescription)) {
                                    $abouthomedescription = $homedescription;
                                } else {
                                    $abouthomedescription = "";
                                }

                                $description = html_entity_decode($aboutcontactus->description);
                                if (isset($description)) {
                                    $aboutdescription = $description;
                                } else {
                                    $aboutdescription = "";
                                }
                                $image = $aboutcontactus->image;
                                if (isset($image)) {
                                    $aboutimage = $image;
                                } else {
                                    $aboutimage = "";
                                }
                                $id = $aboutcontactus->id;
                                if (isset($id)) {
                                    $aboutid = $id;
                                } else {
                                    $aboutid = "";
                                }
                            }
                         @endphp

                        <div class="mt-4">
                            <label class="control-label">Title</label>
                            <textarea name="title" class="form-control form-control-user" id="abouttitle"
                                aria-describedby="description5" placeholder="Enter blog description..." required
                                cols="2" value="{{$abouttitle}}">{{$abouttitle}}</textarea>
                        </div>

                        <div class="mt-4">
                            @if(!empty($aboutimage))
                                <img src="{{ URL::to('about') . "/" . $aboutimage }}" class="rounded img-fluid"
                                    id="showaboutimage" alt="no old image" hight=10% width=10%>
                            @else
                                <img src="{{ URL::to('about') . "/default.jpg" }}" class="rounded img-fluid"
                                    id="showaboutimage" alt="no old image" hight=10% width=10%>
                            @endif
                        </div>

                        <div class="mt-4">
                            <label>Upload Image</label>
                            <input type="hidden" name="id" value="{{$aboutid}}">
                            <inpuT type="hidden" name="oldimage" value="{{$aboutimage}}">
                            <input type="file" class="form-control aboutimage" name="image" id="fileToUpload10"
                                accept="image/png, image/gif, image/jpeg, image/jpg">
                        </div>

                        <div class="mt-4">
                            <label class="control-label">Description For Home Page</label>
                            <textarea name="homedescription" class="form-control form-control-user"
                                id="abouthomedescription" aria-describedby="description6"
                                placeholder="Enter blog description fro home page..." required cols="5"
                                value="{{$abouthomedescription}}">{{$abouthomedescription}}</textarea>
                        </div>


                        <div class="mt-4">
                            <label class="control-label">Description</label>
                            limit <span class="limit">0</span>/2000
                            <textarea name="description" class="form-control form-control-user" id="aboutdescription"
                                aria-describedby="description5"
                                placeholder="Enter blog description...">{!! html_entity_decode($aboutdescription) !!}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Update About us details
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- modal for edit contact us show details -->
<div class="modal fade" id="editcontactus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contact Us</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form class="user" id="formdatacontact" method="POST" action="{{ URL::to('updatecontactus') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @php
                            $contactaddress = "";
                            $contactphone = "";
                            $contactwhatsapp = "";
                            $contactemail = "";
                            $contactid = "";
                            $contactphonearray = [];

                            if (isset($aboutcontactus)) {
                                $address = $aboutcontactus->address;
                                if (isset($address)) {
                                    $contactaddress = $address;
                                } else {
                                    $contactaddress = "";
                                }

                                $phone = $aboutcontactus->phone;
                                if (isset($phone)) {
                                    $contactphone = $phone;
                                } else {
                                    $contactphone = "";
                                }

                                $contactphonearray = explode(",", $contactphone);
                                $phonecount = count($contactphonearray);

                                $whatsapp = $aboutcontactus->whatsapp;
                                if (isset($whatsapp)) {
                                    $contactwhatsapp = $whatsapp;
                                } else {
                                    $contactwhatsapp = "";
                                }

                                $email = $aboutcontactus->email;
                                if (isset($email)) {
                                    $contactemail = $email;
                                } else {
                                    $contactemail = "";
                                }

                                $id = $aboutcontactus->id;
                                if (isset($id)) {
                                    $contactid = $id;
                                } else {
                                    $contactid = "";
                                }
                            }
                         @endphp

                        <div class="mt-4">
                            <label class="control-label">Address</label>
                            <input type="text" class="form-control form-control-user" placeholder="........"
                                name="address" value="{{$contactaddress}}" required autofocus>
                        </div>
                        <div class="mt-4">
                            <label class="control-label">Phone number</label>
                            @foreach ($contactphonearray as $key => $phone)
                                <div class="input-group mb-3">
                                    <span class="input-group-text">+91</span>
                                    <span class="input-group-text"> &nbsp;-&nbsp;</span>
                                    <input type="text" maxlength="10" class="form-control form-control-user" name="phone[]"
                                        value="{{ $phone }}" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required />

                                    @if($key + 1 == $phonecount)
                                        <span class="input-group-text" key="{{$key}}" id="phonenum"><i
                                                class="fa-solid fa-plus"></i></span>
                                    @else
                                        <spann class="input-group-text phonenumminus" key="{{$key}}"><i
                                                class="fa-solid fa-minus"></i></spann>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="contactid" value="{{$contactid}}">
                        <div class="mt-4">
                            <label class="control-label">Whatsapp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">+91</span>
                                <span class="input-group-text"> &nbsp;-&nbsp;</span>
                                <input type="text" maxlength="10" id="whatsapp" name="whatsapp"
                                    pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="{{$contactwhatsapp}}"
                                    class="form-control form-control-user" required style="width: 85%;" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control form-control-user" placeholder="........"
                                name="email" value="{{$contactemail}}" required autofocus>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Update Contact us details
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- modal for add edit alt tag for every images -->
<div class="modal fade" id="addalttag" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alt Tags</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" id="pagetitle"></h5>
                            <!-- need to give image use page link from front end-->
                        </div>
                    </div>
                    <form class="user" id="formdataalt" method="POST" action="{{ URL::to('updatealttag') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="mt-4">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control form-control-user" id="alttitle"
                                placeholder="This is image title" name="title" value="" required autofocus>
                        </div>
                        <input type="hidden" name="relatedid" value="" id="relatedid">
                        <input type="hidden" name="page" value="" id="page">
                        <div class="mt-4">
                            <label class="control-label">Alt Tag Data</label>
                            <input type="text" class="form-control form-control-user" id="alttag"
                                placeholder="this is alt tag for this image" name="alttag" value="" required autofocus>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Update Alt Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- review modal to add customer review -->
<div class="modal fade" id="addcustomerreview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer Review</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="{{ URL::to('addcustomerreview') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="username" class="form-label">Customer name</label>
                            <input type="text" name="user_name" class="form-control" id="username" placeholder="">
                        </div>

                        <div class="mb-4">
                            <label for="exampleFormControlTextarea1" class="form-label">Customer Review</label>
                            <textarea class="form-control" name="review" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Add Review</button>

                    </form>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button"
                    data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="zodiacimageedit" tabindex="-1" aria-labelledby="zodiacimageeditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Zodiac Sign</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('updatezodiacimage') }}" method="POST" enctype="multipart/form-data"
                    id="zodiacsignform">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="zodiacid" class="editzodiacid" value="">
                        <input type="hidden" name="oldimage" class="editzodiacoldimage" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Governing planets</label>
                            <input type="text" name="planet" class="form-control" id="exampleInputEmail1"
                                placeholder="Sun">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="zodiacimage" class="form-control zodiacsign" multiple
                                accept="image/png, image/jpeg, image/jpg">
                            <p class="help-block">Supported format: .jpeg, .jpg, .png</p>
                        </div>
                        <div class="text-center d-grid gap-2">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>