@include('layouts.elements.admin.header') 
<div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      @include('layouts.elements.admin.nav') 
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.elements.admin.sidebar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <form id="health_form" action="{{ url('/insurance/save-motor-insurance') }}" method="POST" enctype="multipart/form-data">
          
                @csrf

                  <div class="card">
                    <div class="card-header">Step 3: Motor Insurance</div>
  
                    <div class="card-body">
  
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
  
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Policy Type</label>
                                  <select class="form-control form-control-lg" id="insurance_type" name="insurance_type">
                                    <option value="">------Choose Option------</option>
                                    <option value="1" @if(isset($motorinsurance))@if($motorinsurance->insurance_type==1) {{ "selected" }} @endif @endif>Comprehensive</option>
                                    <option value="2" @if(isset($motorinsurance))@if($motorinsurance->insurance_type==2) {{ "selected" }} @endif @endif>TP only</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Vehicle Type </label>
                                  <select class="form-control form-control-lg" id="vehicle_type" name="vehicle_type">
                                    <option value="">------Choose Option------</option>
                                    <option value="1"  @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==1) {{ "selected" }} @endif @endif>Car</option>
                                    <option value="2" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==2) {{ "selected" }} @endif @endif>Commercial Vehicle</option>
                                    <option value="3" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==3) {{ "selected" }} @endif @endif>Three Wheeler</option>
                                    <option value="4" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==4) {{ "selected" }} @endif @endif>School Bus</option>
                                    <option value="5" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==5) {{ "selected" }} @endif @endif>PVC</option>
                                    <option value="6" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==6) {{ "selected" }} @endif @endif>Tractor</option>
                                    <option value="7" @if(isset($motorinsurance))@if($motorinsurance->vehicle_type==7) {{ "selected" }} @endif @endif>Two Wheeler</option>
                                  </select>
                            </div>
                            <div class="form-group">
                              <label>Previous year policy number</label>
                              <input type="text" class="form-control form-control-lg" name="previous_year" placeholder="Enter previous year policy number" aria-label="previous_year" value="@if(isset($motorinsurance)){{ $motorinsurance->previous_year }} @endif">
                            </div>
							<div class="form-group">
						     <label>Previous Insurence Document</label>
						     <input type="file" class="form-control form-control-lg" name="previous_document">
						    </div>
							<div class="form-group">
						     <label>Other Document</label>
						     <input type="file" class="form-control form-control-lg" name="other_document">
						    </div>
							<div class="form-group">
						     <label>Insurance Starting Date</label>
						     <input type="text" class="form-control form-control-lg" name="insurance_starting_date" value="@if(isset($motorinsurance)){{ $motorinsurance->insurance_starting_date }} @endif">
						    </div>
							<div class="form-group">
						     <label>Insurance Renewal Date</label>
						     <input type="text" class="form-control form-control-lg" name="insurance_renewal_date" value="@if(isset($motorinsurance)){{ $motorinsurance->insurance_renewal_date }} @endif">
						    </div>
                            <div class="form-group">
                              <label>Remarks</label>
                              <input type="text" class="form-control form-control-lg" name="remarks" placeholder="Enter Remarks" aria-label="remarks" value="@if(isset($motorinsurance)){{ $motorinsurance->remarks }} @endif">
                            </div>
                        </div>
                       <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('selectinsurence') }}" class="btn btn-danger pull-right">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary step-button button-right">Finish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@include('layouts.elements.admin.footer')
@include('layouts.elements.admin.plugins')

<script>
         $('#health_form').validate({ 
            ignore: ".ignore",
            rules: {
                insurance_type: {
                    required: true
                },
                vehicle_type: {
                  required: true,
                },
                previous_year: {
                    required: true
                },
                remarks: {
                    required: true
                },
            },
            messages: {
                insurance_type: "Policy Type is required",
                vehicle_type: "Vehicle Type is required",
                previous_year: "Previous year policy number is required",
                remarks: "Remark is required",
                
            }
        });
    </script>