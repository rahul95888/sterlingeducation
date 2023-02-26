@extends('admin.layouts.master')
@section('title')
    @include('admin.equipments.partials.title')
@endsection
@section('styles')
	
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.equipments.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('equipments.store') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="equipment_name">Equipment Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="equipment_name" id="equipment_name" value="{{ old('equipment_name') }}" required>  
                            @error('equipment_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
        });
    </script>
@endsection