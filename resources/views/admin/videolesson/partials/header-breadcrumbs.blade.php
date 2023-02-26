<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Video Lesson</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('videolesson.index'))
                    <li class="breadcrumb-item" aria-current="page">Video Lesson List</li>
                @elseif(Route::is('videolesson.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Video Lesson</li>
                @elseif(Route::is('videolesson.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Video Lesson</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('videolesson.index'))
                <a href="{{ route('videolesson.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Video Lesson</a>
            @elseif(Route::is('videolesson.create'))
                <a href="{{ route('videolesson.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Video Lesson List</a>
            @elseif(Route::is('videolesson.edit'))
                <a href="{{ route('videolesson.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Video Lesson List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->