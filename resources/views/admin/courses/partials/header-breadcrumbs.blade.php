<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Course</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('course.index'))
                    <li class="breadcrumb-item" aria-current="page">Course List</li>
                @elseif(Route::is('course.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Course</li>
                @elseif(Route::is('course.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Course</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('course.index'))
                <a href="{{ route('course.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Course</a>
            @elseif(Route::is('course.create'))
                <a href="{{ route('course.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Course List</a>
            @elseif(Route::is('course.edit'))
                <a href="{{ route('course.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Course List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->