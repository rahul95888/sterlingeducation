<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Service Allocations</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('service-allocations.index'))
                    <li class="breadcrumb-item" aria-current="page">Service Allocation List</li>
                @elseif(Route::is('service-allocations.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Service Allocation</li>
                @elseif(Route::is('service-allocations.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Service Allocation</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('service-allocations.index'))
                <a href="{{ route('service-allocations.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Service Allocation</a>
            @elseif(Route::is('service-allocations.create'))
                <a href="{{ route('service-allocations.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Service Allocation List</a>
            @elseif(Route::is('service-allocations.edit'))
                <a href="{{ route('service-allocations.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Service Allocation List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->