@extends('admin.layouts.master')
@section('title')
    @include('admin.marketings.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.marketings.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="marketings_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Banner Image</th>
                                <th width="150">Action</th>
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
        let ageTable = $('table#marketings_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('marketings.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
                {data: 'banner_title', name: 'banner_title'},
                {data: 'banner_url', name: 'banner_url'},
                {data: 'banner_image', name: 'banner_image'},

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
