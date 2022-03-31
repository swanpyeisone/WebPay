@extends('frontend.layouts.app')

@section('title','Balance')

@section('header-left')
<a href="{{ route('home') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Balance</h4>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="balance">
            <div class="balance-img">
                <img src="{{ asset('frontend/img/balance.png') }}" alt="">
            </div><br>
            <div class="card">
                <div class="card-body pr-0">
                    <div class="d-flex justify-content-between update-password b-equal">
                        <span>Your Balance</span>
                        <span class="mr-3">{{ $authuser->wallet ? $authuser->wallet->amount : 0 }} MMK</span>
                    </div>
                </div>
            </div><br>
            <div class="card">
                <div class="card-body pr-0">
                    <div class="d-flex justify-content-between update-password b-equal">
                        <span>Account No</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="mr-3">{{ $authuser->wallet ? $authuser->wallet->account_number : '-' }}</span>
                    </div>
                </div>
            </div><br>
        </div>
    </div>
@endsection
