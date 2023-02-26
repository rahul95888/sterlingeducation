@if (Session::has('sticky_error'))
    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
        <div class="text-white">{!! Session::get('sticky_error') !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('sticky_success'))
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
        <div class="text-white">{!! Session::get('sticky_success') !!}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error) 
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $error }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

