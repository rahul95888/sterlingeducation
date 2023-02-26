@extends('admin.layouts.master')
@section('title')
    @include('admin.downloads.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.downloads.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('downloads.update', $downloads->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="address_document">Thumbnail</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-default-file="{{ $downloads->image != null ? '/uploads/property/'.$downloads->image : null }}" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image" />
                                </div>
                            </div>
                        </div> 
                    </div>







                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="pdf">Pdf</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-default-file="{{ $downloads->pdf != null ? '/uploads/property/'.$downloads->pdf : null }}" data-allowed-file-extensions="png jpg jpeg webp pdf" id="pdf" name="pdf" />
                                </div>
                            </div>
                        </div> 
                    </div>








                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required id="title" value="{{ $downloads->title }}" >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="slug">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $downloads->slug }}" required>  
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                 
                  




                   
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                            <textarea  class="form-control" rows="10" cols="50"  name="description" required id="description" value="{{ $downloads->description }}">{{ $downloads->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                 </div> 
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_title">Meta Title<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_title" required id="meta_title" value="{{ $downloads->meta_title }}" >
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_keyword">Meta Keyword<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_keyword" required id="meta_keyword" value="{{ $downloads->meta_keyword }}" >
                            @error('meta_keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_description">Meta Description<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_description" required id="meta_description" value="{{ $downloads->meta_description }}" >
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    
    
    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
            CKEDITOR.replace('description' );
            
        })
    </script>
@endsection
