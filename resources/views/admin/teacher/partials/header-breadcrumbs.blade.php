<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Teacher</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('teacher.index'))
                    <li class="breadcrumb-item" aria-current="page">Teacher List</li>
                @elseif(Route::is('teacher.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Teacher</li>
                @elseif(Route::is('teacher.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Service</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('teacher.index'))
                <a href="{{ route('teacher.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Teacher</a>
            @elseif(Route::is('teacher.create'))
                <a href="{{ route('teacher.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Teacher List</a>
            @elseif(Route::is('teacher.edit'))
                <a href="{{ route('teacher.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Teacher List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->