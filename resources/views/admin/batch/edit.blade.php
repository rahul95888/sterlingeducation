@extends('admin.layouts.master')
@section('title')
    @include('admin.batch.partials.title')
@endsection
@section('styles')
    <style>
        .datepicker{
            top:300px !important;
        }
    </style>
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.batch.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('batch.update', $batch->id) }}" method="POST" enctype="multipart/form-data"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $batch->title }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="startDate">Start Date</label>
                                    <input type="text" class="form-control" name="startDate" id="startDate" value="{{ $batch->startDate }}">
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="form-label" for="startTime">Start Time</label>
                                    <input type="text" class="form-control" name="startTime" id="startTime" value="{{ $batch->startTime }}">
                                    @error('startTime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description">{{ $batch->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                        <div class="form-group">
                            @if($batch->image)
                                <img style="width:40px;" src="{{URL::to('uploads/property/'.$batch->image)}}" />
                            @endif
                            <br/>
                             
                            <label class="form-label" for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 

                        </div>
                    </div>
                     <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary px-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
    $(function() {
        $('#gst_number').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>
    <script>
          $(document).ready(function(){
            $('body').on('focus',".datepicker ", function(){
                $(this).datepicker();
            })
            $(".dropify").dropify();
            
            $("body").on("click", ".remove-procurement", function(e) {
                $(".procurement-next-referral").last().remove();
            });
        });
    </script>
@endsection
