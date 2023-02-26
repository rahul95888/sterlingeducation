@extends('admin.layouts.master')
@section('title')
    @include('admin.traders.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.traders.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-2 gap-3">
                    <div class="ms-auto">
                        <button id="reloadDatatable" class="btn btn-info radius-30 mt-2 mt-lg-0"><i class="bx bx-refresh"></i> Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="traders_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Mobile Number</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Registered From</th>
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
        let tradersTable = $('table#traders_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('traders.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'name', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'registered_from', name: 'registered_from'},
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
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });
    });
</script>
@endsection