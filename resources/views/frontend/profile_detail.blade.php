@extends('frontend.layouts.app')

@section('title','Personal Information')
@section('header-left')
<a href="" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 8px;margin-bottom: 11px;">
        <h6>Personal Information</h6>    
    </a>     
@endsection

@section('content')
    <div class="container">
        <div class="account">
            <div class="profile">
                <img src="https://ui-avatars.com/api/?background=1FD3FF&color=fff&name={{ $user->name }}">
            </div>
            <div class="email">
                <p>Change photo</p>
            </div>
            <div class="card">
                <div class="card-body pr-0">
                    <div class="d-flex justify-content-between">
                        <span>Username</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="mr-3">{{ $user->name }}&nbsp;&nbsp;&nbsp;<a href=""><i class="fas fa-angle-right"></i></a></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Email</span>
                        <span class="mr-3">{{ $user->email }}&nbsp;&nbsp;&nbsp;<a href=""><i class="fas fa-angle-right"></i></a></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Phone</span>
                        <span class="mr-3">{{ $user->phone }}&nbsp;&nbsp;&nbsp;<a href=""><i class="fas fa-angle-right"></i></a></span>
                    </div>
                </div>
            </div><br>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
    })
</script>
@endsection