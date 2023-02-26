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
                    <form action="{{ route('service-allocations.update', $service_allocation->id) }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                        @csrf
                        @method('put')
                        <div class="row " id="allocation">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label class="form-label" for="service_uid">Service <span class="text-danger">*</span></label>
                                    <select class="form-control select2" required name="service_uid" id="service_uid">
                                        <option value="" selected> Select Service</option>
                                        @if($services)
                                            @foreach($services as $service)
                                                @if($service_allocation->service_uid == $service->service_uid)
                                                    <option value="{{ $service->service_uid }}" selected>{{ $service->service_name }}</option>
                                                @else
                                                    <option value="{{ $service->service_uid }}">{{ $service->service_name }}</option>
                                                @endif
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
                                    <label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>
                                    <select class="form-control select2" required name="state_uid" id="state_uid">
                                        <option value="" selected> Select State</option>
                                        @if($states)
                                            @foreach($states as $key => $state)
                                                @if($service_allocation->state_uid == $state->state_uid)
                                                    <option value="{{ $state->state_uid }}" selected>{{ $state->state_name }}</option>
                                                @else
                                                    <option value="{{ $state->state_uid }}">{{ $state->state_name }}</option>
                                                @endif
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
                                    <label class="form-label" for="district_uid">District <span class="text-danger">*</span></label>
                                    <select class="form-control select2" required name="district_uid" id="district_uid">
                                        <option value="" selected> Select District</option>
                                        {{-- @if($districts)
                                            @foreach($districts as $key => $district)
                                                @if($service_allocation->district_uid == $district->district_uid)
                                                    <option value="{{ $district->district_uid }}" data-index="{{ $key }}" selected>{{ $district->district_name }}</option>
                                                @else
                                                    <option value="{{ $district->district_uid }}" data-index="{{ $key }}">{{ $district->district_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </select>
                                    @error('district_uid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                                    <select class="form-control select2" required name="sub_district_uid" id="sub_district_uid">
                                        <option value="" selected> Select Sub District</option>
                                        {{-- @if($sub_districts)
                                            @foreach($sub_districts as $sub_district)
                                                @if($service_allocation->sub_district_uid == $sub_district->sub_district_uid)
                                                    <option value="{{ $sub_district->sub_district_uid }}" selected>{{ $sub_district->sub_district_name }}</option>
                                                @else
                                                    <option value="{{ $sub_district->sub_district_uid }}">{{ $sub_district->sub_district_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </select>
                                    @error('sub_district_uid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>
                                    <select class="form-control select2" required name="village_uid" id="village_uid">
                                        <option value="" selected> Select Village</option>
                                        {{-- @if($villages)
                                            @foreach($villages as $village)
                                                @if($service_allocation->village_uid == $village->village_uid)
                                                    <option value="{{ $village->village_uid }}" selected>{{ $village->village_name }}</option>
                                                @else
                                                    <option value="{{ $village->village_uid }}">{{ $village->village_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </select>
                                    @error('village_uid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-primary px-5">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var district_uid = '{{ $service_allocation->district_uid ? $service_allocation->district_uid : old('district_uid') }}';
        var sub_district_uid = '{{ $service_allocation->sub_district_uid ? $service_allocation->sub_district_uid : old('sub_district_uid') }}';
        var village_uid = '{{ $service_allocation->village_uid ? $service_allocation->village_uid : old('village_uid') }}';

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
