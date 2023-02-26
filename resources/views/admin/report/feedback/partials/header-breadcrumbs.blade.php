<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Feedback Report</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('feedbacks.index'))
                    <li class="breadcrumb-item" aria-current="page">feedback List</li>
                @elseif(Route::is('feedbacks.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New feedback</li>
                @elseif(Route::is('feedbacks.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit feedback</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('feedbacks.index'))
                <a href="{{ route('feedbacks.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add feedback</a>
            @elseif(Route::is('feedbacks.create'))
                <a href="{{ route('feedbacks.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>feedback List</a>
            @elseif(Route::is('feedbacks.edit'))
                <a href="{{ route('feedbacks.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>feedback List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->