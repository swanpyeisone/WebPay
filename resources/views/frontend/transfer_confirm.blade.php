@extends('frontend.layouts.app')

@section('title','Transfer Confirm')

@section('header-left')
<a href="" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h5>Pay Confirm</h5>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 8px;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pr-0">
                        <div class="text-center">
                            <img src="{{ asset('frontend/img/transfer_confirm.png') }}" style="width: 200px" alt="">
                        </div>
                        <form action="{{ route('transfer_complete') }}" method="POST" id="form">
                            @csrf
                            @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" name="hash_value" value="{{ $hash_value }}">
                            <input type="hidden" name="to" value="{{ $check_user->email }}">
                            <input type="hidden" name="amount" value="{{ $to_amount }}">
                            <div class="form-group">
                                <label for="to"><strong>From</strong></label>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $authuser->name }}</p>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $authuser->email }}</p>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $authuser->phone }}</p>
                            </div><hr>
                            <div class="form-group">
                                <label for="to"><strong>To</strong></label>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $check_user->name }}</p>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $check_user->email }}</p>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $check_user->phone }}</p>
                            </div><hr>
                            <div class="form-group">
                                <label for="to"><strong>Amount (MMK)</strong></label>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ number_format($to_amount) }}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <button class="btn btn-theme btn-block comfirm-btn my-3">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.comfirm-btn').on('click',function(e){
                e.preventDefault();

                Swal.fire({
                    title: '<strong>Enter your password</strong>',
                    
                    html:
                        '<input type="password" class="form-control text-center password"/>',
                    showCloseButton: true,
                   confirmButtonText:'Enter',

                }).then((result) => {
                    if (result.isConfirmed) {
                        var password = $('.password').val();
                        $.ajax({
                            url: '/transfer/password-check?password='+password,
                            type:'GET',
                            success: function(res){
                                if(res.status == 'success'){
                                    $('#form').submit();
                                }else{
                                    Swal.fire(res.message);
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
