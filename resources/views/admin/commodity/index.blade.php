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
<?php 
use App\Helpers\Helpers;
?>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($i = "1")
                            @foreach($datas as $data)
                            <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->name }}</td>
                             
                            <td><a class="btn btn-primary btn-sm me-3" title="Edit Commodity Details" href="{{ route('commodities.edit', $data->id) }}">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm deleteItem" title="Delete Farmer" data-id="{{$data['id']}}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="deleteForm{{$data->id}}" action="{{route('commodities.destroy', [$data->id])}}" method="post" style="display:none">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                                class="icofont icofont-check"></i> Confirm Delete</button>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Cancel</button>
                                    </form> </td>
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
        $('#commodities_table').DataTable({
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
        $('.deleteItem').on('click',function(){
            let id = $(this).data('id')
            swal.fire({ 
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.value) {
                    $("#deleteForm"+id).submit();
                }
            })
        });
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });
    });
</script>
@endsection
