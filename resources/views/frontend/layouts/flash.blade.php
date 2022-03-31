@if (count($errors))
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
    </div>
    @endforeach
@endif
