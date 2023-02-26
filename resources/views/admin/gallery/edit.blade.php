@extends('admin.layouts.master')
@section('title')
    @include('admin.gallery.partials.title')
@endsection
@section('styles')
	<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.gallery.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')


                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $gallery->title }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                     
                    
                    

                    
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php if($gallery->image != NULL){
                                    ?>
                                    <img src="/uploads/property/{{$gallery->image }}" style="width:40px; height:40px;" class="img-fluid thumb-img" />  
                                     <?php
                                }?>
                            <label class="form-label" for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @error('image')
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
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            // CKEDITOR.replace( 'gallery_content' );
            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            $('.select2').select2(
                {
                    theme: 'bootstrap4',
                }
            );
        });
    </script>
@endsection
