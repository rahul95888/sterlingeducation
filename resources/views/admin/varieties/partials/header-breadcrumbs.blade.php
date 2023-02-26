<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Varieties</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('varieties.index'))
                    <li class="breadcrumb-item" aria-current="page">Variety List</li>
                @elseif(Route::is('varieties.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Variety</li>
                @elseif(Route::is('varieties.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Variety</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('varieties.index'))
                <a href="{{ route('varieties.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Variety</a>
            @elseif(Route::is('varieties.create'))
                <a href="{{ route('varieties.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Variety List</a>
            @elseif(Route::is('varieties.edit'))
                <a href="{{ route('varieties.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Variety List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->