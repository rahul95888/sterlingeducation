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
                        <tbody>
                        @php($i = "1")
                            @foreach($datas as $data)
                            <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <?php
                            if ($data->user_type == 'farmer') {
                                echo 'Farmer';
                            } else if ($data->user_type == 'fpo') {
                                echo 'FPO';
                            } else if ($data->user_type == 'trader') {
                                echo 'Trader';
                            } else if ($data->user_type == 'processor') {
                                echo 'Processor';
                            }
                            ?>
                        </td>
                            <td>{{$data->rate}}</td>
                            <td>{{$data->message}}</td>
                            <td>{{$data->created_at}}</td>
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
    $(document).ready(function(){
        $('#feedback_table').DataTable({
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    'bSortable': false,
                    'bSearchable': false,
                    "className": "text-center",
                    'aTargets': [-1]
                }
            ]
        });
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });
    });
</script>
@endsection