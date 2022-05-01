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

            <form id="health_insurance" action="{{ url('/insurance/save-health-insurance') }}" method="POST" enctype="multipart/form-data">
                @csrf

                  <div class="card">
                    <div class="card-header">Step 3: Health Insurance</div>
  
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
                                    <option value="1"  @if(isset($healthinsurance))@if($healthinsurance->insurance_type==1) {{ "selected" }} @endif @endif>Individual</option>
                                    <option value="2"  @if(isset($healthinsurance))@if($healthinsurance->insurance_type==1) {{ "selected" }} @endif @endif>Floater Policy</option>
                                  </select>
                            </div>
                            <div class="form-group">
                              <label>Previous year policy number</label>
                              <input type="text" class="form-control form-control-lg" name="previous_year" placeholder="Enter previous year policy number" aria-label="previous_year" value="@if(isset($healthinsurance)){{ $healthinsurance->previous_year }} @endif">
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
                              <label>Remarks</label>
                              <input type="text" class="form-control form-control-lg" name="remarks" placeholder="Enter Remarks" aria-label="remarks" value="@if(isset($healthinsurance)){{ $healthinsurance->remarks }} @endif">
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
         $('#health_insurance').validate({ 
            ignore: ".ignore",
            rules: {
                insurance_type: {
                    required: true
                },
                previous_year: {
                  required: true,
                },
                remarks: {
                    required: true
                },
            },
            messages: {
                insurance_type: "Policy Type is required",
                previous_year: "Previous year policy number is required",
                remarks: "Remark is required",
                
            }
        });
    </script>
