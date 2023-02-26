@extends('admin.layouts.master')
@section('title')
    @include('admin.fpos.partials.title')
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
        @include('admin.fpos.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('fpos.update', $data->id) }}" method="POST" enctype="multipart/form-data"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="feedback_uid">Customer Name</label>
                                    <input type="text"    class="form-control" name="feedback_uid" id="feedback_uid" value="{{ $data->feedback_uid }}">
                                    @error('feedback_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                    </div>
                   
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="rate">Sub Title</label>
                                    <input type="text" class="form-control" name="rate" id="rate" value="{{ $data->rate }}">
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="message">Message</label>
                                    <textarea class="form-control" name="message" id="message">{{ $data->message }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                          
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-default-file="{{URL::to('/uploads/property/'.$data->image)}}"
                                     data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image"/>
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
