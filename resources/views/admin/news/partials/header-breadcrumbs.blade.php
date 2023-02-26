<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">News</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('news.index'))
                    <li class="breadcrumb-item" aria-current="page">News List</li>
                @elseif(Route::is('news.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New News</li>
                @elseif(Route::is('news.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit News</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('news.index'))
                <a href="{{ route('news.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add News</a>
            @elseif(Route::is('news.create'))
                <a href="{{ route('news.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>News List</a>
            @elseif(Route::is('news.edit'))
                <a href="{{ route('news.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>News List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->