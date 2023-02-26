<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Marketing and Promo</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('marketings.index'))
                    <li class="breadcrumb-item" aria-current="page">Marketing and Promo List</li>
                @elseif(Route::is('marketings.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Marketing and Promo</li>
                @elseif(Route::is('marketings.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Marketing and Promo</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('marketings.index'))
                <a href="{{ route('marketings.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Marketing and Promo</a>
            @elseif(Route::is('marketings.create'))
                <a href="{{ route('marketings.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Marketing and Promo List</a>
            @elseif(Route::is('marketings.edit'))
                <a href="{{ route('marketings.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Marketing and Promo List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->