<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Categories</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('commodities.index'))
                    <li class="breadcrumb-item" aria-current="page">Category List</li>
                @elseif(Route::is('commodities.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Category</li>
                @elseif(Route::is('commodities.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Category</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('commodities.index'))
                <a href="{{ route('commodities.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Category</a>
            @elseif(Route::is('commodities.create'))
                <a href="{{ route('commodities.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Category List</a>
            @elseif(Route::is('commodities.edit'))
                <a href="{{ route('commodities.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Category List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->