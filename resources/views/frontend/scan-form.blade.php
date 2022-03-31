@extends('frontend.layouts.app')

@section('title','Scan Form')

@section('header-left')
<a href="" class="back-btn">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h5>Scan Form</h5>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 8px;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pr-0 mb-2">
                        <div class="text-center">
                            <img src="{{ asset('frontend/img/undraw_transfer.png') }}" style="width: 200px" alt="">
                        </div>
                        <form action="{{ route('scan-confirm') }}" method="GET" id="transfer_form">
                            <input type="hidden" name="hash_value" class="hash_value" value="">
                            <input type="hidden" name="to" class="to" value="{{ $to_account->email }}">
                            <div class="form-group">
                                <label for="to"><strong>From</strong></label>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $from_account->name }}</p>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $from_account->email }}</p>
                                <p class="mb-1 text-muted" style="font-size: 18px;">{{ $from_account->phone }}</p>
                            </div><hr>
                            <div class="form-group">
                                <label for="to"><strong>To</strong></label>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $to_account->name }}</p>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $to_account->email }}</p>
                                <p class="mb-1 text-muted" style="font-size: 20px;">{{ $to_account->phone }}</p>
                            </div><hr>
                            @error('to_email')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="amount">Amount (MMK)</label>
                                <input type="number" class="form-control amount" name="amount" placeholder="eg.1000 MMK">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <button class="btn btn-theme btn-block next-btn my-3">Next</button>
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
            $('.next-btn').on('click',function(e){
                e.preventDefault();
                var to_email = $('.to').val();
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
        })
    </script>
@endsection
