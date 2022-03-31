@extends('frontend.layouts.app')

@section('title','Update Password')
@section('header-left')
<a href="" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Update Password</h4>    
    </a>     
@endsection
@section('content')
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="height:80vh;margin-top: 40px;">
                <div class="col-md-6">
                    <div class="card auth-form">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('frontend/img/update-password.png') }}" alt="">
                            </div>
                            <form method="POST" action="{{ route('update-password.updated') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="password" class="col-md-6 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                </div>
        
                                <div class="form-group">
                                    <label for="password" class="col-md-6 col-form-label text-md-right">{{ __('New Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="new_password" required autocomplete="new-password">
                                </div>
        
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-md-6 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                                </div>
        
                                <div class="row">
                                    <button class="btn btn-theme btn-block my-3">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        
    })
</script>
@endsection