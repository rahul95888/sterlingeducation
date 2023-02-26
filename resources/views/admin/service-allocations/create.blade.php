@extends('admin.layouts.master')
@section('title')
    @include('admin.service-allocations.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.service-allocations.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body pt-4">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('service-allocations.store') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                   <div class=" row allocation ">
                    <div class="col-md-6 pt-2">
                        <div class="form-group">
                            <label class="form-label" for="service_uid">Service <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="service_uid" id="service_uid" required>
                                <option value="" selected> Select Service</option>
                                @if($services)
                                    @foreach($services as $service)
                                        <option value="{{ $service->service_uid }}" @if(old('service_uid') == $service->service_uid) selected @endif> {{$service->service_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('service_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                        <div class="form-group">
                            <label class="form-label" for="state_uid">State<span class="text-danger">*</span></label>
                            <select class="form-control state_uid select2" required name="state_uid" id="state_uid">
                                <option value="" selected disabled> Select State</option>
                                @if($states)
                                    @foreach($states as $state)
                                        <option value="{{ $state->state_uid }}" @if(old('state_uid') == $state->state_uid) selected @endif> {{$state->state_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('state_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                        <div class="form-group">
                            <label class="form-label" for="district_uid">District<span class="text-danger">*</span></label>
                            <select class="form-control district_uid select2" name="district_uid" required id="district_uid">
                                <option value="" selected disabled> Select District</option>
                            </select>
                            @error('district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                        <div class="form-group">
                            <label class="form-label" for="sub_district_uid">Sub District<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="sub_district_uid" required id="sub_district_uid">
                                <option value="" selected disabled> Select Sub District</option>
                            </select>
                            @error('sub_district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 pt-2">
                        <div class="form-group">
                            <label class="form-label" for="village_uid">Village<span class="text-danger">*</span></label>
                            <select class="form-control select2" required name="village_uid" id="village_uid">
                                <option value="" selected disabled> Select Village</option>
                            </select>
                            @error('village_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        var district_uid = '{{ old('district_uid') }}';
        var sub_district_uid = '{{ old('sub_district_uid') }}';
        var village_uid = '{{ old('village_uid') }}';

        $('#state_uid').on('change',function(){
            
            $('#district_uid').html('');
            var state_uid= this.value;
            $.ajax({
                url: "{{ url('district/fetch') }}",
                type:"POST",
                data:{
                    state_uid: state_uid,
                    _token:'{{ csrf_token() }}'
                } ,
                dataType:'json',
                success:function(district){
                    $('#district_uid').append('<option> Select District </option>');
                    $.each(district,function(key, value){
                        if(value.district_uid === district_uid){
                            $('#district_uid').append('<option value="'+ value.district_uid +'" selected>'+ value.district_name +'</option>')
                        }else{
                            $('#district_uid').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                        }
                    });
                    $('#district_uid').trigger('change');
                }
            });
        });

        $('#state_uid').trigger('change');

        $('#district_uid').on('change',function(){
            
            var district_uid = this.value;
            $('#sub_district_uid').html('');
            $.ajax({
                url:"{{ url('sub-district') }}",
                type: "POST",
                data:{
                    district_uid: district_uid,
                    _token: '{{ csrf_token() }}'
                },
                dataType:'json',
                success:function(result){
                    $("#sub_district_uid").append("<option>Select Sub-District</option>");
                    $.each(result.subDistrict, function (key,value){
                        if(value.sub_district_uid == sub_district_uid){
                            $("#sub_district_uid").append('<option value="'+ value.sub_district_uid +'" selected>'+ value.sub_district_name +'</option>');
                        }else{
                            $("#sub_district_uid").append('<option value="'+ value.sub_district_uid +'">'+ value.sub_district_name +'</option>');
                        }
                    });
                    $('#sub_district_uid').trigger('change');
                }
            });
        });


        $("#sub_district_uid").on('change',function(){
            var sub_district_uid =this.value;
            $('#village_uid').html('');
            $.ajax({
                url  : "{{ url('village/fetch') }}",
                type : "POST",
                data : {
                    sub_district_uid: sub_district_uid,
                    _token : '{{ csrf_token() }}'
                },
                dataType:'json',
                success:function(result){
                    $("#village_uid").append("<option>Select Village</option>");
                    $.each(result.village,function (key,value) {
                        if(value.village_uid == village_uid){
                            $("#village_uid").append('<option value="'+ value.village_uid +'" selected>'+ value.village_name +'</option>');
                        }else{
                            $("#village_uid").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                        }
                    });
                }
            });
        });

        $('.select2').select2({  theme: 'bootstrap4', });

    });
</script>
@endsection
