@extends('admin.layouts.master')
@section('title')
    @include('admin.processingservices.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processingservices.partials.header-breadcrumbs-allocation')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="services_allocation_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Processing Services</th>
                                <th>Processors</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="allocationDiv">
        
    </div>
    
</div>
@endsection
@section('scripts')

<script>
function showAddAllocation(){
 $.ajax({
    type: "get",
    dataType:"json",			
    url: "{{ route('add_allocationservices') }}",
    data:{ },
    beforeSend: function(){
    },
    error:function(error){
        $.each(error.responseJSON.errors, function(index, value){
            toastr.error(value);
        })
    },
    success: function(data){
       
        if(data.error==0){     
            $('#allocationDiv').html(data.html);
            $('.allocationModal').modal('show');             
        }
    }
});
}

function allocationSubmit(){
	event.preventDefault();
	// setup some local variables
	var $form = $(this);
	var serializedData = $('#allocationForm').serialize();
	var action=$('#allocationForm').attr('action');
		$.ajax({
			type: "POST",
			url: action,
			data: serializedData,
			dataType: "json",
			success: function(result) {			
				if (result.success == 1) {
						toastr.success(result.msg);
						$('#allocationModal').modal('hide');
                        location.reload();
					} else {
						toastr.error(result.msg);
					}
			}
		});
};



$(document).ready(function(){
let serviceTable = $('table#services_allocation_table').DataTable({
    language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
    processing: true,
    serverSide: true,
    ajax: {url: "{{ route('allocationservices') }}"},
    aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
    buttons: [],
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'Service', name: 'Service'},
        {data: 'Processor', name: 'Processor'},
        {data: 'action', name: 'action'}
    ]
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
let commodities = <?php echo json_encode($commodities->toArray()); ?>;

$('#createNewServiceAllocation').click(function () {
    alert();
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
        url: "{{ route('edit_allocationservices') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            if(data.error==0){     
                $('#allocationDiv').html(data.html);
                $('.allocationModal').modal('show');             
            }
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
                url: "{{ route('delete_allocationservices') }}",
                success: function (response) {
                    toastr.success(response.msg);
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