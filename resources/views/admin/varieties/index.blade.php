@extends('admin.layouts.master')
@section('title')
    @include('admin.varieties.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.varieties.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="varieties_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Variety Name</th>
                                <th>Commodity</th>
                                <th>From Price</th>
                                <th>To Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($i = "1")
                      
                            @foreach($datas as $data)
                            <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->variety_name }}</td>
                            <td>{{ $data->commodity->name }}</td>
                            <td>{{ $data->from_price }}</td>
                            <td>{{ $data->to_price }}</td>
                            <td>
                            <a class="btn btn-primary btn-sm me-3" title="Edit Variety Details" href="{{ route('varieties.edit', $data->id) }}">
                                <i class="bx bx-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm deleteItem" title="Delete Farmer" data-id="{{$data['id']}}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="deleteForm{{$data->id}}" action="{{route('varieties.destroy', [$data->id])}}" method="post" style="display:none">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                                class="icofont icofont-check"></i> Confirm Delete</button>
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Cancel</button>
                                    </form>
                                </td>
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
        $('#varieties_table').DataTable({
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

       

        $('#varieties_table').on('click','.deleteItem',function () {
           
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