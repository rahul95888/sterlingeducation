@extends('admin.layouts.master')
@section('title')
    @include('admin.report.feedback.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.report.feedback.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-2 gap-3">
                    <div class="ms-auto">
                        <button id="reloadDatatable" class="btn btn-info radius-30 mt-2 mt-lg-0"><i class="bx bx-refresh"></i> Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="feedback_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>User Type</th>
                                <th>Rate</th>
                                <th>Message</th>
                                <th>Created On</th>
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
        let ageTable = $('table#feedback_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('feedbacks') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'user_type', name: 'user_type'},
                {data: 'rate', name: 'rate'},
                {data: 'message', name: 'message'},
                {data: 'created_at', name: 'created_at'}
            ]
        });
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });
    });	
</script>
@endsection