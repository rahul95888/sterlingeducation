@extends('admin.layouts.master')
@section('title')
    @include('admin.downloads.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.downloads.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-2 gap-3">
                    <div class="ms-auto">
                        <button id="reloadDatatable" class="btn btn-info radius-30 mt-2 mt-lg-0"><i class="bx bx-refresh"></i> Refresh</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="processors_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Thumbnail</th>
                                <th>Pdf</th>
                                <th>title</th>
                                <th>description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = "1")
                            @foreach($datas as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->price }}</td>

                                <td>
                                {{ $data->type }}
                                   
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm me-3" title="Edit Processor Details" href="{{ route('downloads.edit', $data['id']) }}">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                     <button class="btn btn-danger btn-sm deleteItem" title="Delete Processor" data-id="{{$data['id']}}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="deleteForm{{$data['id']}}" action="{{route('downloads.destroy', [$data['id']])}}" method="post" style="display:none">
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
        $('#processors_table').DataTable({
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
        // let processorsTable = $('table#processors_table').DataTable({
        //     language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
        //     processing: true,
        //     serverSide: true,
        //     ajax: {url: "{{ route('processors.index') }}"},
        //     aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
        //     buttons: [],
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {data: 'id', name: 'id'},
        //         {data: 'mobile_number', name: 'mobile_number'},
        //         {data: 'name', name: 'name'},
        //         {data: 'company_name', name: 'company_name'},
        //         {data: 'number_of_farmers_connected', name: 'number_of_farmers_connected'},
        //         {data: 'registered_from', name: 'registered_from'},
        //         {data: 'action', name: 'action'}
        //     ],
        //     "columnDefs": [
        //         {
        //             "targets": 0,
        //             'bSortable': true,
        //             "className": "text-center",
        //         },
        //         {
        //             'bSortable': false,
        //             "className": "text-center",
        //             'aTargets': [-1]
        //         }
        //     ],
        // });
        $('#reloadDatatable').on('click', function(){
            window.location.reload();
        });
    });
</script>
@endsection
