@extends('backend.layouts.app')
@section('title','Edit User')
@section('user-active','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> Edit User</div>
        </div>   
    </div>
</div>

<div class="content pt-3">
    <div class="card">
        <div class="card-body">
            @include('backend.layouts.flash')
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" id="update">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" autocomplete="off" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" autocomplete="off" name="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" autocomplete="off" class="form-control" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" autocomplete="off" class="form-control">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mr-2">Confirm</button>
                    <button class="btn btn-secondary back-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateUser','#update') !!}
    <script>
        $(document).ready(function() {
            
        } );
    </script>
@endsection