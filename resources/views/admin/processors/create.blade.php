@extends('admin.layouts.master')
@section('title')
    @include('admin.processors.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processors.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('processors.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="equipment_name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="equipment_name" required id="equipment_name" value="{{ old('equipment_name') }}" >
                            @error('equipment_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="slug">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" required id="slug" value="{{ old('slug') }}" >
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                            <textarea  class="form-control" rows="10" cols="50"  name="description" required id="description" value="{{ old('description') }}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="itinerary">Additional Information <span class="text-danger">*</span></label>
                            <textarea  class="form-control" rows="10" cols="50"  name="itinerary" required id="itinerary" value="{{ old('itinerary') }}"></textarea>
                            @error('itinerary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                     
                     
                    
                     
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="google_location">Short Description </label>
                            <input type="text" class="form-control" name="google_location" id="google_location" value="{{ old('google_location') }}">
                            @error('google_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>  


                     
                    

                     
                   


                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="lounge">Amount<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="lounge" required id="lounge" value="{{ old('lounge') }}" >
                            @error('Lounge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 


                     
                    
                     
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="address_document">Thumbnail</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="address_document" name="thumb" />
                                </div>
                            </div>
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
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
    $(function() {
        $('#gst_number').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'description' );
            CKEDITOR.replace('itinerary');
            $(".dropify").dropify();
            $('.select2').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            
             
           
            
        })
    </script>
@endsection
