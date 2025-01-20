@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4"><a href="{{ URL::to('adminreviewmanage') }}">Reviews</a> / Edit Reviews</h2>
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
            <form method="POST" action="{{ URL::to('updatereview') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="form-label">Customer name</label>
                    <input type="text" name="user_name" class="form-control" id="username" placeholder="" value="{{ $review->user_name}}">
                </div>
                <input type="hidden" name="id" value="{{ $review->id}}">
                <div class="mb-4">
                    <label for="exampleFormControlTextarea1" class="form-label">Customer Review</label>
                    <textarea class="form-control" name="review" id="exampleFormControlTextarea1" rows="3">{{$review->review }}</textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Update Review</button>

            </form>
        </div>
    </div>
</main>
<!-- /.container-fluid -->
@endsection