@extends('admin.layouts.master')
@section('title')
    @include('admin.news.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.news.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="news_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:100px">Sr. No</th>
                                <th>Title</th>
                                <th>Commodity</th>
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
        let ageTable = $('table#news_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('news.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'commodity.name', name: 'commodity.name'},
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
