@extends('admin.layouts.master')
@section('title')
    @include('admin.teacher.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.job.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="title">Job Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="location"> Job location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}"  >
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"  >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    



                            <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="salary">Salary<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="salary" id="salary" value="{{ old('salary') }}"  >
                            @error('salary')
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
            CKEDITOR.replace( 'commodity_uid' );     
        });
    </script>
@endsection
