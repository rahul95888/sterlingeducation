<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Downloads</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('downloads.index'))
                    <li class="breadcrumb-item" aria-current="page">Downloads List</li>
                @elseif(Route::is('downloads.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Downloads</li>
                @elseif(Route::is('downloads.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Downloads</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('downloads.index'))
                <a href="{{ route('downloads.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Downloads</a>
            @elseif(Route::is('downloads.create'))
                <a href="{{ route('downloads.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Downloads List</a>
            @elseif(Route::is('downloads.edit'))
                <a href="{{ route('downloads.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Downloads List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->