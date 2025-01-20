@extends('layouts.adminlayout')
@section('content')
<!-- Begin Page Content -->
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4"><strong>
                @if ($page_name === null)
                    client
                @else
                    {{ $page_name}}
                @endif
            </strong>
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


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Horoscopes
            </div>
            <div class="card-body">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button btn-secondary " type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                aria-controls="flush-collapseOne" style="background:#d9e3ef;">
                                Daily Horoscopes
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show "
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <form action="{{ URL::to('updatehoroscope') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="dailyscope">File input</label>
                                            <input type="hidden" name="horoscopetype" value="D">
                                            <input type="file" id="dailyscope" name="files[]"
                                                class="form-control dailyhoroscopefile" multiple>
                                            <p class="help-block">Note: Supported image format: .jpeg, .jpg, .png, .gif
                                            </p>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary dailyhoroscopesubmit">Submit</button>
                                    </form>
                                </div>
                                <div>

                                </div>
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ol class="breadcrumb mb-4">
            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
        </ol>

    </div>
</main>
<!-- /.container-fluid -->
@endsection