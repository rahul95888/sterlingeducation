<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Faq</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('services.index'))
                    <li class="breadcrumb-item" aria-current="page">Faq List</li>
                @elseif(Route::is('services.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Faq</li>
                @elseif(Route::is('services.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Faq</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('services.index'))
                <a href="{{ route('services.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Faq</a>
            @elseif(Route::is('services.create'))
                <a href="{{ route('services.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Faq List</a>
            @elseif(Route::is('services.edit'))
                <a href="{{ route('services.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Faq List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->