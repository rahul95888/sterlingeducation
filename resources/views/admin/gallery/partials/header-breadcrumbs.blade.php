<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Gallery</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('gallery.index'))
                    <li class="breadcrumb-item" aria-current="page">Gallery List</li>
                @elseif(Route::is('gallery.create'))
                    <li class="breadcrumb-item" aria-current="page">Create Gallery</li>
                @elseif(Route::is('gallery.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Gallery</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('gallery.index'))
                <a href="{{ route('gallery.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Slider</a>
            @elseif(Route::is('gallery.create'))
                <a href="{{ route('gallery.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Slider List</a>
            @elseif(Route::is('gallery.edit'))
                <a href="{{ route('gallery.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Slider List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->