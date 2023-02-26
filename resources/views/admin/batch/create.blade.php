@extends('admin.layouts.master')
@section('title')
    @include('admin.batch.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

        <style>
        .datepicker{
            top:300px !important;
        }
    </style>
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.batch.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('batch.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
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
                                    <input type="date" class="form-control" name="startDate" id="startDate" value="{{ old('startDate') }}">
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="form-label" for="startTime">Start Time</label>
                                    <input type="text" class="form-control" name="startTime" id="startTime" value="{{ old('startTime') }}">
                                    @error('startTime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                        <div class="form-group">
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
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
    $(function() {
        $('#gst_number').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>
    <script rel="text/javascript">
        $(document).ready(function(){

            $(".dropify").dropify();
            $('#procurement_state_uid').trigger('change');

           
           

            
             
            $("body").on("click", ".remove-procurement", function(e) {
                $(".procurement-next-referral").last().remove();
            });
        });
    </script>
@endsection
