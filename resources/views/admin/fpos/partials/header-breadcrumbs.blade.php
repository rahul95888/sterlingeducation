<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Testimonial</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('fpos.index'))
                    <li class="breadcrumb-item" aria-current="page">Testimonial List</li>
                @elseif(Route::is('fpos.create'))
                    <li class="breadcrumb-item" aria-current="page">Create Testimonial</li>
                @elseif(Route::is('fpos.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Testimonial</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('fpos.index'))
                <a href="{{ route('fpos.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Testimonial</a>
            @elseif(Route::is('fpos.create'))
                <a href="{{ route('fpos.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Testimonial List</a>
            @elseif(Route::is('fpos.edit'))
                <a href="{{ route('fpos.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Testimonial List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->