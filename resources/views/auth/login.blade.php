@extends('frontend.layouts.app_plain')
@section('title','Login')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="col-md-6">
            <div class="card auth-form">
                <div class="card-header">{{ __('Swan Pay') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="login">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('frontend/img/login.png') }}" style="width: 120px;">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        </div>
                        <div class="row">
                            <button class="btn btn-theme btn-block my-3">Log in</button>
                        </div>
                        <div class="row justify-content-between"> 
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forget your password?
                                </a>
                            @endif
                            <a class="mb-2" href="{{ route('register') }}">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\LoginRequest','#login') !!}
@endsection
