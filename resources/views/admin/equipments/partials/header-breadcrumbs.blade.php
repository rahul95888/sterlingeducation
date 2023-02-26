<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Equipments</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('equipments.index'))
                    <li class="breadcrumb-item" aria-current="page">Equipment List</li>
                @elseif(Route::is('equipments.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Equipment</li>
                @elseif(Route::is('equipments.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Equipment</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('equipments.index'))
                <a href="{{ route('equipments.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Equipment</a>
            @elseif(Route::is('equipments.create'))
                <a href="{{ route('equipments.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Equipment List</a>
            @elseif(Route::is('equipments.edit'))
                <a href="{{ route('equipments.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Equipment List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->