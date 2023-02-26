<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Job</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('job.index'))
                    <li class="breadcrumb-item" aria-current="page">Job List</li>
                @elseif(Route::is('job.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Job</li>
                @elseif(Route::is('job.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Service</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('job.index'))
                <a href="{{ route('job.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Job</a>
            @elseif(Route::is('job.create'))
                <a href="{{ route('job.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Job List</a>
            @elseif(Route::is('job.edit'))
                <a href="{{ route('job.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Job List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->