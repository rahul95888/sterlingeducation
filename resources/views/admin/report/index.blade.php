@extends('admin.layouts.master')
@section('title')
    @include('admin.report.partials.title')
@endsection
@section('styles')
@endsection
@section('admin-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Procurement Report</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('procurement_filter') }}" >
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="user_type">Select User <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="user_type" id="user_type">
                                        <option value="" disabled selected> Select User</option>
                                        <option value="farmer" @if(!empty($user_type) && ($user_type=='farmer')) selected @endif >Farmer</option>
                                        <option value="fpo" @if(!empty($user_type) && ($user_type=='fpo')) selected @endif >FPO</option>
                                        <option value="trader" @if(!empty($user_type) && ($user_type=='trader')) selected @endif >Trader</option>
                                        <option value="processor" @if(!empty($user_type) && ($user_type=='processor')) selected @endif>Processor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="warehouse_type_uid">Select Warehouse Type</label>
                                    <select class="form-control select2" name="warehouse_type_uid" id="warehouse_type_uid">
                                        <option value="" disabled selected> Select Warehouse Type</option>
                                        @foreach($warehouse_types as $warehouse_type)
                                        <option value="{{ $warehouse_type->warehouse_type_uid }}" @if(!empty($warehouse_type_uid) && ($warehouse_type_uid==$warehouse_type->warehouse_type_uid)) selected @endif >{{ $warehouse_type->warehouse_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="state_uid">Select State</label>
                                    <select class="form-control select2" name="state_uid" id="state_uid">
                                        <option value="" disabled selected> Select State</option>
                                        @foreach($states as $pstate)
                                        <option value="{{ $pstate->state_uid }}" @if(!empty($state_uid) && ($state_uid==$pstate->state_uid)) selected @endif >{{ $pstate->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="district_uid">Select District</label>
                                    <select class="form-control select2" name="district_uid" id="district_uid">
                                        <option value="" disabled selected> Select District</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="sub_district_uid">Select Sub District</label>
                                    <select class="form-control select2" name="sub_district_uid" id="sub_district_uid">
                                        <option value="" disabled selected> Select Sub District</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="village_uid">Select Village</label>
                                    <select class="form-control select2" name="village_uid" id="village_uid">
                                        <option value="" disabled selected> Select Village</option>
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="district_uid">From Date</label>
                                    <input type="date"  value="<?php if(!empty($from_date)){ echo $from_date; } ?>" class="form-control" name="from_date" placeholder="From Date" />
                                </div>
                            </div>

                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="district_uid">To Date</label>
                                    <input type="date" value="<?php if(!empty($to_date)){ echo $to_date; } ?>" class="form-control" name="to_date" placeholder="From Date" />
                                </div>
                            </div> -->

                            <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('procurement_report') }}" type="button" class="btn btn-info">Reset Filter</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-2 gap-3">
                        <div class="ms-auto">
                            <button id="reloadDatatable" class="btn btn-info radius-30 mt-2 mt-lg-0"><i class="bx bx-refresh"></i> Refresh</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Warehouse Address</th>
                                    <th>Warehouse Capacity</th>
                                    <th>Warehouse Type</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Sub-district</th>
                                    <th>Village</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = "1")
                                @foreach($result as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['mobile'] }}</td>
                                    <td>{{ $data['warehouse_address'] }}</td>
                                    <td>{{ $data['warehouse_capacity'] }}</td>
                                    <td>{{ $data['warehouse_type_uid'] }}</td>
                                    <td>{{ $data['state_uid'] }}</td>
                                    <td>{{ $data['district_uid'] }}</td>
                                    <td>{{ $data['sub_district_uid'] }}</td>
                                    <td>{{ $data['village_uid'] }}</td>
                                    <td>{{ $data['added_on'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({theme: 'bootstrap4',});
        $('#myTable').DataTable({
            "dom": 'Bfrtip',
            aLengthMenu: [[20,50, 100, 1000, -1], [20,50, 100, 1000, "All"]],
            'buttons'   : ['excel','csv','print'],
            // "buttons": [
            //     {
            //         extend: 'collection',
            //         text: 'Export',
            //         buttons: ['excel','csv','print']
            //     }
            // ]
        });
        var district_uid = '{{ isset($district_uid) ? $district_uid : '' }}';
        var sub_district_uid = '{{ isset($sub_district_uid) ? $sub_district_uid : '' }}';
        var village_uid = '{{ isset($village_uid) ? $village_uid : '' }}';

        $('#state_uid').on('change',function(){
            
            $('#district_uid').html('');
            var state_uid = this.value;
            $.ajax({
                url: "{{ url('district/fetch') }}",
                type:"POST",
                data:{
                    state_uid: state_uid,
                    _token:'{{ csrf_token() }}'
                } ,
                dataType:'json',
                success:function(district){
                    $('#district_uid').append("<option value=''> Select District </option>");
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
                    $("#sub_district_uid").append("<option value=''> Select District </option>");
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
                    $("#village_uid").append("<option value=''> Select District </option>");
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
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });

    });
</script>

@endsection

