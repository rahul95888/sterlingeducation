<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Slider</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('pops.index'))
                    <li class="breadcrumb-item" aria-current="page">Slider List</li>
                @elseif(Route::is('pops.create'))
                    <li class="breadcrumb-item" aria-current="page">Create Slider</li>
                @elseif(Route::is('pops.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Slider</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('pops.index'))
                <a href="{{ route('pops.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Slider</a>
            @elseif(Route::is('pops.create'))
                <a href="{{ route('pops.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Slider List</a>
            @elseif(Route::is('pops.edit'))
                <a href="{{ route('pops.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Slider List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->