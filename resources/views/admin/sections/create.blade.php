@extends('admin.layouts.master')
@section('title')
    @include('admin.sections.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.sections.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('sections.store') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>  
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="section_content">Section Content <span class="text-danger">*</span></label>
                            <textarea name="section_content" id="section_content" cols="30" rows="10" required>{{ old('section_content') }}</textarea>
                            @error('section_content')
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
            // CKEDITOR.replace( 'section_content' );
        });
    </script>
@endsection