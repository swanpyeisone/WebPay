@extends('frontend.layouts.app')

@section('title','Profile')

@section('header-left')
<a href="" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection

@section('extra-header')
<a href="" class="logout">
    <i class="fas fa-sign-out-alt"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Profile</h4>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="">
            <div class="profile">
                <img src="https://ui-avatars.com/api/?background=1FD3FF&color=fff&name={{ $user->name }}">
            </div>
            <div class="username">
                <p>{{ $user->name }}</p>
            </div>
            <div class="email">
                <p>{{ $user->email }}</p>
            </div>
            <div class="card">
                <div class="card-body pr-0">
                    <a href="{{ route('profile-detail') }}" class="d-flex justify-content-between update-password">
                        <span>Personal Information</span>
                        <span class="mr-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i></span>
                    </a>
                    <hr>
                    <a href="" class="d-flex justify-content-between update-password">
                        <span>Notifications</span>
                        <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                    </a> 
                </div>
            </div><br>
            <div class="card">
                <div class="card-body pr-0">
                    <a href="{{ route('update-password') }}" class="d-flex justify-content-between update-password">
                        <span>Update Password</span>
                        <span class="mr-3"><i class="fas fa-angle-right"></i></span>
                    </a>
                </div>
            </div><br>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.logout', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure. You want to Logout?',
                showCancelButton: true,
                confirmButtonText: `Confirm`,
            }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : '{{ route('logout') }}',
                            type : 'POST',
                            success : function(){
                                window.location.replace("{{ route('profile') }}")
                            }
                        });
                    } 
                })
        })
    })
</script>
@endsection