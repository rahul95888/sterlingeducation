<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">MockTest</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('mocktest.index'))
                    <li class="breadcrumb-item" aria-current="page">MockTest List</li>
                @elseif(Route::is('mocktest.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New MockTest</li>
                @elseif(Route::is('mocktest.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit MockTest</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('mocktest.index'))
                <a href="{{ route('mocktest.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add MockTest</a>
            @elseif(Route::is('mocktest.create'))
                <a href="{{ route('mocktest.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>MockTest List</a>
            @elseif(Route::is('mocktest.edit'))
                <a href="{{ route('mocktest.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>MockTest List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->