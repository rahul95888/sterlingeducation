@extends('admin.layouts.master')
@section('title')
    @include('admin.user-privilege.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.user-privilege.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-2 gap-3">
                    <div class="ms-auto">
                        <button id="reloadDatatable" class="btn btn-info radius-30 mt-2 mt-lg-0"><i class="bx bx-refresh"></i> Refresh</button>
                    </div>
                </div>
    <table class="table table-striped table-bordered">
        <thead>
            <th>sno</th>
            <th>User Name</th>
            <th>Role Name</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php if(!empty($data)){
                $i=1;
                foreach($data as $val){
                    ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->rolename}}</td>
                        <td> <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addrole{{$val->id}}"><i class="bx bx-edit"></i></button>
                           </td>
                            <div class="modal fade" id="addrole{{$val->id}}" tabindex="-1" aria-labelledby="addcomment" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-sm-5 mx-50 pb-5">
                                        <h1 class="text-center mb-1" id="addcomment">Role</h1>
                                        <p class="text-center">Select a role</p>

                                        <!-- form -->
                                        <form class="row gy-1 gx-2 mt-75"  action="<?php echo route('update-role')?>"  method="post">
                                    
                                        {{csrf_field()}}
                                        <input type="hidden" id="myid" name="myid" value="{{$val->id}}">
                                            <div class="col-md-12">
                                                <select class="form-control" name="role_uid">
                                                    <option value="">Select Role</option>
                                                    <?php
                                                    if(!empty($roles)){
                                                foreach($roles as $value){
                                                    ?>
                                                    <option value="{{$value->role_uid}}">{{$value->name}}</option>
                                                    <?php
                                                    }  } ?>
                                                </select>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-1 mt-1">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    </tr>
                    <?php
                }
            } ?>
        </tbody>
    </table>     
            </div>
        </div>
      
</div>
@endsection
@section('scripts')

@endsection