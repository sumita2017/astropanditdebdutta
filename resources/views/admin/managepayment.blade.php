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
        @if($paymentdetails != null)
                @php
                    $paymentamount = $paymentdetails->paymentamount;
                    $marchecntkey = $paymentdetails->marchecntkey;
                    $apikey = $paymentdetails->apikey;
                    $apiindex = $paymentdetails->apiindex;
                    $hosturl = $paymentdetails->hosturl;
                @endphp
        @else
                @php
                    $paymentamount = "";
                    $marchecntkey = "";
                    $apikey = "";
                    $apiindex = "";
                    $hosturl = "";
                @endphp
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Payment Gateway management
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <form method="POST" action="{{ URL::to('updatepaymentdetails') }}">
                        @csrf
                        <label for="basic-url" class="form-label">Amount</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" name="paymentamount" class="form-control"
                                aria-label="Amount (to the nearest dollar)" value="{{ (int) $paymentamount / 100 }}">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="mb-4">
                            <label for="marchecntkey" class="form-label">Marchecnt Id</label>
                            <input type="text" name="marchecntkey" class="form-control" id="marchecntkey" placeholder=""
                                value="{{$marchecntkey}}">
                        </div>

                        <div class="mb-4">
                            <label for="hosturl" class="form-label">Host URL</label>
                            <input type="text" name="hosturl" class="form-control" id="hosturl" placeholder=""
                                value="{{$hosturl}}">
                        </div>

                        <div class="mb-4">
                            <label for="apikey" class="form-label">API Key</label>
                            <input type="text" name="apikey" class="form-control" id="apikey" placeholder=""
                                value="{{$apikey }}">
                        </div>

                        <div class="mb-4">
                            <label for="apiindex" class="form-label">API Index</label>
                            <input type="text" name="apiindex" class="form-control" id="apiindex" placeholder=""
                                value="{{ $apiindex }}">
                        </div>
                        <button type="submit" class="btn btn-secondary">Update payment details</button>
                    </form>
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