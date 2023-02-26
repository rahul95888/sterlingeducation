@extends('admin.layouts.master')
@section('title')
    @include('admin.processingservices.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processingservices.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="services_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Commodity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalServiceHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="serviceForm" name="serviceForm" class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">  
                            </div>
                            <input type="hidden" id="service_id" name="service_id">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">Commodity <span class="text-danger">*</span></label>
                                <select class="form-control" name="commodity_id" id="commodity_id">
                                    <option value="" selected> Select Commodity</option>
                                </select> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" id="saveServiceBtn" class="btn btn-primary"></button>
                    <button type="submit" id="updateServiceBtn" class="btn btn-primary d-none"></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function(){
        let serviceTable = $('table#services_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('processingservices') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'commodity_id', name: 'commodity_id'},
                {data: 'action', name: 'action'}
            ],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let commodities = <?php echo json_encode($commodities->toArray()); ?>;

        $('#createNewService').click(function () {
            $('#commodity_id').html('<option value="">Select Commodity</option>');
            $.each(commodities, function (index, value) {
                $('#commodity_id').append('<option value="'+value.commodity_uid+'">'+value.name +'</option>');
            });
            $('#updateServiceBtn').addClass("d-none");
            $('#saveServiceBtn').removeClass("d-none");
            $('#saveServiceBtn').html("Save");
            $('#service_id').val('');
            $('#serviceForm').trigger("reset");
            $('#modalServiceHeading').html("Create Service");
        });
        $('.closeBtn').on('click', function(){
            location.reload()
        });
        $('#saveServiceBtn').click(function (e) {
            e.preventDefault();

            let formData = {
                name: $('#serviceForm input[name="name"').val(),
                commodity_id: $('#serviceForm select[name="commodity_id"').val(),
            };
        
            $.ajax({
                data: formData,
                url: "{{ route('add_processingservices') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#serviceForm').trigger("reset");
                    $('#serviceModal').modal('hide');
                    toastr.success(response.message);
                    serviceTable.draw();
                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function(index, value){
                        toastr.error(value);
                    })
                }
            });
        });

        $('body').on('click', '#editService', function () {
            var service_id = $(this).data('id');
            let formData = {
                service_id: service_id
            };
            $.ajax({
                data: formData,
                url: "{{ route('get_processingservices_by_id') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    if(response){
                        console.log(response);
                        
                        $('#commodity_id').html('<option value="">Select Commodity</option>');
                        $.each(commodities, function (index, value) {
                            if(response.commodity_id == value.commodity_uid){
                                $('#commodity_id').append('<option value="'+value.commodity_uid+'" selected>'+value.name +'</option>');
                            }else{
                                $('#commodity_id').append('<option value="'+value.commodity_uid+'">'+value.name +'</option>');
                            }
                        });

                        $('#modalServiceHeading').html("Edit Service");
                        $('#updateServiceBtn').removeClass("d-none");
                        $('#saveServiceBtn').addClass("d-none");
                        $('#updateServiceBtn').html("Update");

                        $('#service_id').val(response.id);
                        $('#name').val(response.name);
                        $('#commodity_id').val(response.commodity_id);
                        $('#serviceModal').modal('show');
                    }
                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function(index, value){
                        toastr.error(value);
                    })
                }
            });
        });

        $('#updateServiceBtn').click(function (e) {
            e.preventDefault();

            let formData = {
                name: $('#serviceForm input[name="name"').val(),
                commodity_id: $('#serviceForm select[name="commodity_id"').val(),
                service_id: $('#serviceForm input[name="service_id"').val(),
            };
        
            $.ajax({
                data: formData,
                url: "{{ route('update_processingservices') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#serviceForm').trigger("reset");
                    $('#serviceModal').modal('hide');
                    toastr.success(response.message);
                    serviceTable.draw();
                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function(index, value){
                        toastr.error(value);
                    })
                }
            });
        });

        $('body').on('click', '#deleteService', function () {
     
            var service_id = $(this).data("id");
            swal.fire({ 
                title: "Are you sure?",
                text: "Service will be deleted permanently!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!"       
            }).then((result) => { 
                if (result.value) {
                    let formData = {
                        service_id: service_id
                    };
                    $.ajax({
                        type: "post",
                        data:formData,
                        url: "{{ route('delete_processingservices') }}",
                        success: function (response) {
                            toastr.success(response.message);
                            serviceTable.draw();
                        },
                        error: function (error) {
                            $.each(error.responseJSON.errors, function(index, value){
                                toastr.error(value);
                            })
                        }
                    });
                }
            })
        });
    });
</script>
@endsection