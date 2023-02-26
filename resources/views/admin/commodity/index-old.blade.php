@extends('admin.layouts.master')
@section('title')
    @include('admin.commodity.partials.title')
@endsection
@section('styles')
    <style>
        .text-right{
            text-align: right !important;
        }
    </style>
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.commodity.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="commodities_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Image</th>
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
        let ageTable = $('table#commodities_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('commodities.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex',  name: 'DT_RowIndex', orderable: false, searchable: false} ,
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
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
