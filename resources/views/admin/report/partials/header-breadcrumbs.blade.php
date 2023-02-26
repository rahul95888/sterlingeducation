<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Procurement Report</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('processors.index'))
                    <li class="breadcrumb-item" aria-current="page">Property List</li>
                @elseif(Route::is('processors.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Property</li>
                @elseif(Route::is('processors.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Property</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('processors.index'))
                <a href="{{ route('processors.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Property</a>
            @elseif(Route::is('processors.create'))
                <a href="{{ route('processors.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Property List</a>
            @elseif(Route::is('processors.edit'))
                <a href="{{ route('processors.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Property List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->