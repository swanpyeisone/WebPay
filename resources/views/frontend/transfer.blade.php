@extends('frontend.layouts.app')

@section('title','Transfer')

@section('header-left')
<a href="{{ route('home') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Pay</h4>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 10px;">
            <div class="col-md-8">
                <div class="card auth-form">
                    <div class="card-body pr-0">
                        <div class="text-center">
                            <img src="{{ asset('frontend/img/money_transfer.png') }}" style="width: 200px" alt="">
                        </div>
                        <form action="{{ route('transfer_confirm') }}" method="GET" autocomplete="off" id="transfer_form" class="transfer_vali">
                            <input type="hidden" name="hash_value" class="hash_value" value="">
                            <div class="form-group">
                                <label for="to">To</label>
                                <input type="email" class="form-control to_email" name="to" placeholder="Email" autofocus>
                                @error('to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label for="amount">Amount (MMK)</label>
                                <input type="number" class="form-control amount" name="amount" placeholder="eg.1000 MMK">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="row">
                                <button class="btn btn-theme btn-block my-3 next-btn">Next</button>
                            </div>
                        </form>
                    </div>
                </div><br>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\TransferValidate','.transfer_vali') !!}
<script>
    $(document).ready(function() {
        $('.next-btn').on('click',function(e){
            e.preventDefault();
            var to_email = $('.to_email').val();
            var amount = $('.amount').val();
            $.ajax({
                url: `/transfer-hash?to_email=${to_email}&amount=${amount}`,
                type:'GET',
                success: function(res){
                    if(res.status == 'success'){
                        $('.hash_value').val(res.data);
                        $('#transfer_form').submit();
                    }
                }
            });
        });
    } );
</script>
@endsection