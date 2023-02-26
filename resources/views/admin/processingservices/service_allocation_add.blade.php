<div class="modal fade allocationModal" id="allocationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalServiceHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="allocationForm" action="{{ route('add_allocationservices_submit') }}" name="allocationForm" class="row g-3">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">Processing Services <span class="text-danger">*</span></label>
                                <select class="form-control" required name="service_id" id="commodity_id">
                                    <option value="" disabled selected> Select Service</option>
                                    @foreach($processingservice as $pservice)
                                    <option value="{{ $pservice->id }}" @if(!empty($result)) @if($result->service_id==$pservice->id)  selected   @endif   @endif > {{ $pservice->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <input type="hidden" value="@if(!empty($result)){{ $result->id }}@endif" name="id" />

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">Processor <span class="text-danger">*</span></label>
                                <select class="form-control" required name="processor_id" id="commodity_id">
                                    <option value="" disabled selected> Select Processor</option>
                                    @foreach($processor as $pro)
                                    <option value="{{ $pro->id }}" @if(!empty($result)) @if($result->processor_id==$pro->id)  selected   @endif   @endif > {{ $pro->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">State <span class="text-danger">*</span></label>
                                <select class="form-control" required name="state_id" id="commodity_id">
                                    <option value="" disabled selected> Select State</option>
                                    @foreach($state as $state)
                                    <option value="{{ $state->id }}" @if(!empty($result)) @if($result->state_id==$state->id)  selected   @endif   @endif > {{ $state->state_name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">District <span class="text-danger">*</span></label>
                                <select class="form-control" required name="district_id" id="commodity_id">
                                    <option value="" disabled selected> Select District</option>
                                    @foreach($district as $district)
                                    <option value="{{ $district->id }}" @if(!empty($result)) @if($result->district_id==$district->id)  selected   @endif   @endif > {{ $district->district_name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">Sub District <span class="text-danger">*</span></label>
                                <select class="form-control" required name="sub_district_id" id="commodity_id">
                                    <option value="" disabled selected> Select Sub District</option>
                                    @foreach($subdistrict as $subdistrict)
                                    <option value="{{ $subdistrict->id }}" @if(!empty($result)) @if($result->sub_district_id==$subdistrict->id)  selected   @endif   @endif > {{ $subdistrict->sub_district_name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="commodity_id">Village <span class="text-danger">*</span></label>
                                <select class="form-control" required name="village_id" id="commodity_id">
                                    <option value="" disabled selected> Select Village</option>
                                    @foreach($village as $village)
                                    <option value="{{ $village->id }}" @if(!empty($result)) @if($result->village_id==$village->id)  selected   @endif   @endif > {{ $village->village_name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" onclick="allocationSubmit()" id="saveServiceBtn" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>