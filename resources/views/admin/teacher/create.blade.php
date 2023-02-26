@extends('admin.layouts.master')
@section('title')
    @include('admin.teacher.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.teacher.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="teacher_name">Teacher Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" value="{{ old('teacher_name') }}">
                            @error('teacher_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="subtitle">Subtitle Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subtitle" id="teacher_name" value="{{ old('subtitle') }}"  >
                            @error('subtitle')
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
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image"/>
                                </div>
                            </div>



                            <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="experiences">Experience<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="experiences" id="experiences" value="{{ old('experiences') }}"  >
                            @error('experiences')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"  >
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="experiences" value="{{ old('email') }}"  >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="	mobile">Mobile<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}"  >
                            @error('mobile')
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
