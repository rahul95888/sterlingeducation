<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Traders</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('traders.index'))
                    <li class="breadcrumb-item" aria-current="page">Trader List</li>
                @elseif(Route::is('traders.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Trader</li>
                @elseif(Route::is('traders.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Trader</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('traders.index'))
                <a href="{{ route('traders.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Trader</a>
            @elseif(Route::is('traders.create'))
                <a href="{{ route('traders.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Trader List</a>
            @elseif(Route::is('traders.edit'))
                <a href="{{ route('traders.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Trader List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->