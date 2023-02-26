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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="service_allocations_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Service</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Sub District</th>
                                <th>Village</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function(){
        let serviceAllocationsTable = $('table#service_allocations_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('service-allocations.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'service_uid', name: 'service_uid'},
                {data: 'state_uid', name: 'state_uid'},
                {data: 'district_uid', name: 'district_uid'},
                {data: 'sub_district_uid', name: 'sub_district_uid'},
                {data: 'village_uid', name: 'village_uid'},
                {data: 'action', name: 'action'}
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    'bSortable': false,
                    "className": "text-center",
                    'aTargets': [-1]
                }
            ],
        });
    });
</script>
@endsection