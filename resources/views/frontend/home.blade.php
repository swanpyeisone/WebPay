@extends('frontend.layouts.app')

@section('title','Swan Pay')

@section('header-center')
<div class="profile-image">
    <a href="{{ route('profile') }}">
        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $user->name }}">
    </a>
</div>
@endsection
@section('header-left')
<a href="">
    <i class="fas fa-bell"></i>
</a>
@endsection
@section('extra-header')
<a href="{{ route('profile') }}">
    <i class="fas fa-user-cog"></i>
</a>
@endsection

@section('content')
   <div class="container mt-2">
       <a href="{{ route('balance') }}">
        <div class="card">
            <div class="card-body b-home">
                <div class="d-flex justify-content-between">
                    <h5><strong>Your Balance</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <h1>{{ $user->wallet ? $user->wallet->amount : 0 }} MMK</h1>
                </div>
            </div>
        </div>
        </a><br>
        <div class="card">
            <div class="card-body pr-0">
                <a href="{{ route('scan') }}" class="d-flex justify-content-between update-password" style="color: black">
                    <span><img src="{{ asset('frontend/img/b-scan.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Scan</span>
                    <i class="fas fa-angle-right mt-1"></i>
                </a>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body pr-0">
                <a href="{{ route('qrcode') }}" class="d-flex justify-content-between update-password" style="color: black">
                    <span><img src="{{ asset('frontend/img/qr_new.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get paid</span>
                    <i class="fas fa-angle-right mt-1"></i>
                </a>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body pr-0">
                <a href="{{ route('transfer') }}" class="d-flex justify-content-between update-password" style="color: black">
                    <span><img src="{{ asset('frontend/img/send-money.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send</span>
                    <i class="fas fa-angle-right mt-1"></i>
                </a>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body pr-0">
                <a href="{{ route('transaction') }}" class="d-flex justify-content-between update-password" style="color: black">
                    <span><img src="{{ asset('frontend/img/transfer.png') }}" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction details</span>
                    <i class="fas fa-angle-right mt-1"></i>
                </a>
            </div>
        </div>
   </div>
@endsection
@section('footer')
<div class="bottom-menu">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row ">
                <div class="col-3 text-center">
                    <a href="{{ route('scan') }}" class="scan-img">
                        <img src="{{ asset('frontend/img/b-scan.png') }}" alt="">
                        <p>Scan</p>
                    </a>
                </div>
                <div class="col-3 text-center">
                    <a href="{{ route('qrcode') }}" class="scan-img">
                        <img src="{{ asset('frontend/img/qr_new.png') }}" alt="">
                        <p>Get paid</p>
                    </a>
                </div>
                <div class="col-3 text-center">
                    <a href="{{ route('balance') }}" class="scan-img">
                        <img src="{{ asset('frontend/img/wallet.png') }}" alt="">
                        <p>Balance</p>
                    </a>
                </div>
                <div class="col-3 text-center">
                    <a href="{{ route('transaction') }}" class="scan-img">
                        <img src="{{ asset('frontend/img/transfer.png') }}" alt="">
                        <p>Transactions</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
