@extends('frontend.layouts.app')

@section('title','Balance')

@section('header-left')
<a href="{{ url('/') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px;">
        <h4>Transaction</h4>    
    </a>     
@endsection
@section('content')
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-7">
                    <div class="input-group my-2">
                        <label class="input-group-text p-1"><i class="fas fa-filter"></i></label>
                        <input type="text" class="form-control date" value="{{ request()->date ?? date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            @foreach ($transactions as $transaction)
                <a href="{{ url('/transaction/'. $transaction->trx_id) }}">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="mb-0 d-flex justify-content-between update-password b-equal">
                                <p class="">{{ $transaction->created_at }}</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <P class="text-success">
                                    @if ($transaction->type == 1)
                                        +
                                    @else
                                        -
                                    @endif
                                    {{ $transaction->amount }}
                                </P>
                            </div>    
                                <p class="mb-0">
                                    @if ($transaction->type == 1)
                                        <img class="" src="{{ asset('frontend/img/receive-money.png') }}" style="width: 35px" alt="">
                                        <span class=""> &nbsp;&nbsp;To {{ $transaction->source ? $transaction->source->name : '' }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span style="font-size: 15px">No. {{ $transaction->trx_id }}</span>
                                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span style="font-size: 15px" class="text-muted">Money received</span>
                                        </span>
                                    @else
                                        <img src="{{ asset('frontend/img/send-money.png') }}" style="width: 35px" alt="">
                                        <span class=""> &nbsp;&nbsp;To {{ $transaction->source ? $transaction->source->name : '' }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span style="font-size: 15px">No. {{ $transaction->trx_id }}</span>
                                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span style="font-size: 15px" class="text-muted">Money sended</span>
                                        </span>
                                    @endif
                                    
                                </p>
                        </div>
                    </div><br>
                </a>
            @endforeach
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "locale": {
                    "format": "YYYY/MM/DD",
                },
            }); 
            $('.date').on('apply.daterangepicker', function(ev, picker) {
                var date = $('.date').val();
                history.pushState(null, '', `?date=${date}`);
                window.location.reload();
            });
        });
    </script>
@endsection
