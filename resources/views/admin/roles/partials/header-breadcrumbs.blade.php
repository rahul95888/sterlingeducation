<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Roles</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('all-roles'))
                    <li class="breadcrumb-item" aria-current="page">All Roles</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('all-roles'))
                <a href="{{ route('add-role') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Role</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->