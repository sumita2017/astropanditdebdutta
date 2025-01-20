@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Edit Admin User</h2>
        <div class="row">

            <form method="POST" action="{{ URL::to('updateadminuser') }}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$admin->id}}">
                    <input type="text" class="form-control form-control-user" id="name" placeholder="Admin Name" name="name" value="{{$admin->name}}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="exampleFormControlSelect1">User type</label><select class="form-control form-control-solid" name="usertype" id="exampleFormControlSelect1" value="{{$admin->usertype}}">
                        <option value="0" @if($admin->usertype === "0") selected @endif>
                            Master Admin
                        </option>
                        <option value="1" @if($admin->usertype === "1") selected @endif>
                            Sub Admin
                        </option>
                        <option value="2" @if($admin->usertype === "2") selected @endif>
                            Seo management
                        </option>
                        <option value="4" @if($admin->usertype === "4") selected @endif>
                            Appointment Management
                        </option>
                        <option value="5" @if($admin->usertype === "5") selected @endif>
                            Blog Management
                        </option>
                    </select>
                </div>

                <!-- Email Address  -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control form-control-solid" type="email" name="email" :value="old('email', $admin->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password  -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" class="form-control form-control-solid" type="password" name="password" maxlength="10" autocomplete="new-password" aria-placeholder="**********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password  -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="form-control form-control-solid" type="password" name="password_confirmation" maxlength="10" autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-primary-button class="ms-4 btn btn-primary">
                        {{ __('Update Admin') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection