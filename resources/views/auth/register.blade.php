@extends('frontend.layouts.app_plain')
@section('title','Register')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="col-md-6">
            <div class="card auth-form">
                <div class="card-header">{{ __('Swan Pay') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="register">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="off" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                        </div>

                        <div class="row">
                            <button class="btn btn-theme btn-block my-3">Sign Up</button>
                        </div>
                        <div class="row justify-content-between"> 
                            <a class="mb-2" href="{{ route('login') }}">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\RegisterRequest','#register') !!}
<script>
    $(document).ready(function() {
        
    } );
</script>
@endsection
