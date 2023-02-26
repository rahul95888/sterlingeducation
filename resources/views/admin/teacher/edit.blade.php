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
                <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <div class="form-group">
                            
                            <label class="form-label" for="teacher_name">Teacher Name <span class="text-danger">*</span></label>


                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" value="{{ $teacher->teacher_name }}" required>
                            
                            
                            @error('teacher_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="subtitle_name">Subtitle Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $teacher->subtitle }}" required>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"  >{{ $teacher->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                    <img src="{{URL::to('/uploads/property/'.$teacher->image)}}" style="width:50px;" />
                                <div class="form-group">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image" {{ $teacher->Image }}/>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="form-label" for="experiences">Experience<span class="text-danger">*</span></label>
                            
                            <input type="text" class="form-control" name="experiences" id="experiences" value="{{ $teacher->experiences }}"  >
                            
                            
                            @error('experiences')
                                <div class="invalid-feedback">{{ $teacher->experiences }}</div>
                            @enderror
                        </div>

                            <div class="col-md-12">
                        <div class="form-group">
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $teacher->address }}"  >
                            @error('address')
                                <div class="invalid-feedback">{{ $teacher->address }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="experiences" value="{{ $teacher->email }}"  >
                            @error('email')
                                <div class="invalid-feedback">{{ $teacher->email }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="	mobile">Mobile<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $teacher->mobile }}"  >
                            @error('mobile')
                                <div class="invalid-feedback">{{ $teacher->mobile }}</div>
                            @enderror
                        </div>
                    </div>
                    <br/>
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