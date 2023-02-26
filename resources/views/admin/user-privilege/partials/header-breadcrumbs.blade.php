<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Privileges</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('user_privileges'))
                    <li class="breadcrumb-item" aria-current="page">Admin Users List</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('user_privileges'))
                <a href="{{ route('add-admin') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Admin User</a>
           @endif  
        </div>
    </div>
</div>
<!--end breadcrumb-->