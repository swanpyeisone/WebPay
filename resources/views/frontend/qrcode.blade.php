@extends('frontend.layouts.app')

@section('title','Get paid')

@section('header-left')
<a href="{{ route('home') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Get paid</h4>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="text-center"  style="margin-top: 40px;margin-bottom: 20px;">
            <strong><h3>{{ $authuser->name }}</h3></strong>
        </div>
        <div class="card">
            <div class="card-body qr">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($authuser->email)) !!} ">
            </div>
        </div>
    </div>
@endsection
