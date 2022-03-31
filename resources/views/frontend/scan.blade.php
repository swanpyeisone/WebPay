@extends('frontend.layouts.app')

@section('title','Scan')

@section('header-left')
<a href="{{ route('home') }}">
    <i class="fas fa-arrow-left"></i>
</a>
@endsection
@section('header-center')
    <a href="" style="margin-top: 5px; ">
        <h4>Scan</h4>    
    </a>     
@endsection
@section('content')
    <div class="container" style="margin-top: 20px;">
        @include('frontend.layouts.flash')
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <video id="scan" style="width: 300px;"></video>
                </div>
                <div class="text-center mt-2">
                   <button class="btn btn-theme" id="start" style="width: 120px;">Scan</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('scripts')
    <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var videoElem = document.getElementById('scan');
            QrScanner.WORKER_PATH = "{{ asset('js/qr-scanner-worker.min.js') }}";
            const qrScanner = new QrScanner(videoElem, function(result){
                if(result){
                    qrScanner.stop();

                    var to_email = result;
                    window.location.replace(`scan/form?to_email=${to_email}`);
                }
            });
            $('#start').on('click',function(){
                qrScanner.start();
            })
        });
    </script>
@endsection
