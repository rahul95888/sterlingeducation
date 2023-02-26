@extends('admin.layouts.master')
@section('title')
    @include('admin.user-privilege.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.user-privilege.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-2 gap-3">
                    <div class="ms-auto">
                    </div>
                </div>
                <form action="{{ route('add-admin') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">User Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>  
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">User Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>  
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password">User Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" minlength="8" name="password" id="password" value="{{ old('password') }}" required>  
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label class="form-label" for="confirmpassword">Confirm Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" minlength="8" name="confirmpassword" id="confirmpassword" value="{{ old('confirmpassword') }}" required>  
                            @error('confirmpassword')
                                <div class="invalid-feedback">{{ $confirmpassword }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <select class="form-control" name="role_uid">
                            <option value="">Select Role</option>
                            <?php
                            if(!empty($roles)){
                        foreach($roles as $value){
                            ?>
                            <option value="{{$value->role_uid}}">{{$value->name}}</option>
                            <?php
                            }  } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
      
</div>
@endsection
@section('scripts')

@endsection