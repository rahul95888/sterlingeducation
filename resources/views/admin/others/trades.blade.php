@extends('admin.layouts.master')
@section('title')
    Trade List | Admin Panel - 
    {{ config('app.name') }} 
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
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Trades</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Trade List</li>
                    </ol>
                </nav>
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
                    <table id="trades_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Commodity</th>
                                <th>Variety</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Address</th>
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
        let tradesTable = $('table#trades_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('trades') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'commodity_uid', name: 'commodity_uid'},
                {data: 'variety_uid', name: 'variety_uid'},
                {data: 'quantity', name: 'quantity'},
                {data: 'price', name: 'price'},
                {data: 'address', name: 'address'},
                {data: 'action', name: 'action'}
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    "targets": 4,
                    "className": "text-right",
                },
                {
                    "targets": 5,
                    "className": "text-right",
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