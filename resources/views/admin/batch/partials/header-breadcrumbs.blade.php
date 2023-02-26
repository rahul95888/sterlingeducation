<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Upcoming Batch</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('batch.index'))
                    <li class="breadcrumb-item" aria-current="page">Batch List</li>
                @elseif(Route::is('batch.create'))
                    <li class="breadcrumb-item" aria-current="page">Create Batch</li>
                @elseif(Route::is('batch.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Batch</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('batch.index'))
                <a href="{{ route('batch.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Batch</a>
            @elseif(Route::is('batch.create'))
                <a href="{{ route('batch.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Batch List</a>
            @elseif(Route::is('batch.edit'))
                <a href="{{ route('batch.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Batch List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->