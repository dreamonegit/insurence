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

            <form id="step_two" action="{{ url('/insurance/save-insurance-type') }}" method="POST">
                @csrf

                  <div class="card">
                    <div class="card-header">Step 2: Insurance Type</div>
  
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
  
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1" class="required">Insurance Type</label>
                                      <select class="form-control form-control-lg" id="insurance_type" name="insurance_type">
                                        <option value="">------Choose Option------</option>
                                        <option value="1" @if(isset($insurance))@if($insurance->insurance_type==1) {{ "selected" }} @endif @endif >Health Insurance</option>
                                        <option value="2" @if(isset($insurance))@if($insurance->insurance_type==2) {{ "selected" }} @endif @endif >Motor Insurance</option>
    									<option value="3" @if(isset($insurance))@if($insurance->insurance_type==3) {{ "selected" }} @endif @endif >Life Insurance</option>
                                      </select>
                                </div>
                                 <div class="form-group col-md-3">
                                    <label class="required">Insurance Date</label>
                                    <input type="date" class="form-control form-control-lg" name="insurance_date" placeholder="Enter the Insurance Date" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->insurance_date }}@endif">
                                </div>                           
                                <div class="form-group col-md-3">
                                    <label class="required">Insurance Expiry Date</label>
                                    <input type="date" class="form-control form-control-lg" name="insurance_expiry_date" placeholder="Enter the Insurance Date" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->insurance_expiry_date }} @endif">
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">SM/SSM Name</label>
                                    <input type="text" class="form-control form-control-lg" name="sm_ssm" placeholder="Enter the SM/SSM Name" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->sm_ssm_name }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Advisor's Payone hub Code</label>
                                    <input type="text" class="form-control form-control-lg" name="advisor_code" placeholder="Enter the Advisor's Payone hub Code" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->payonehub_code }}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">Advisor's Policybazaar code</label>
                                    <input type="text" class="form-control form-control-lg" name="policybazaar_code" placeholder="Enter the Advisor's Policybazaar code" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->policybazaar_code }} @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Advisor Name</label>
                                    <input type="text" class="form-control form-control-lg" name="advisor_name" placeholder="Enter the Advisor Name" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->advisor_name }}@endif">
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">Application Number</label>
                                    <input type="text" class="form-control form-control-lg" name="application_number" placeholder="Enter the Application Number" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->application_no }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Company Name</label>
                                    <input type="text" class="form-control form-control-lg" name="company_name" placeholder="Enter the Company Name" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->company_name }}@endif">
                                </div>
                            </div>                
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('addinsurence') }}" class="btn btn-danger pull-right ">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary step-button button-right">Next</button>
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
         $('#step_two').validate({ 
            ignore: ".ignore",
            rules: {
                insurance_type: {
                    required: true
                },
                insurance_date: {
                    required: true
                },
                sm_ssm: {
                    required: true
                },
                advisor_code: {
                    required: true
                },                
                policybazaar_code: {
                    required: true
                },        
                advisor_name: {
                    required: true
                },        
                application_number: {
                    required: true
                },
                company_name: {
                    required: true
                },                 
            },
             messages: {
                insurance_type: "Insurance Type is required",
                insurance_date: "Insurance Type is required",
                sm_ssm: "SM/SSM Name is required",
                advisor_code: "Advisor's Payone hub Code is required",
                policybazaar_code: "Advisor's Policybazaar code is required",
                advisor_name: "Advisor Name is required",
                application_number: "Application Number is required",
                company_name: "Company Name is required",
            }
        });
    </script>