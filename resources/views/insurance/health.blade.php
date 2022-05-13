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
                    <div class="card-header">Step 3: Insurance</div>
  
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
                                    <label class="required">Plan Name</label>
                                    <input type="text" class="form-control form-control-lg" name="plan_name" placeholder="Enter the Plan Name" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->plan_name }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Sum Assumed</label>
                                    <input type="text" class="form-control form-control-lg" name="sum_assumed" placeholder="Enter the Sum Assumed" aria-label="Staff Name" value="@if(isset($insurance)){{$insurance->sum_assured}}@endif">
                                </div>
                            </div>        

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">EMI</label>
                                    <input type="number" class="form-control form-control-lg" name="emi" placeholder="Enter the EMI" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->emi }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">EMI Month</label>
                                    <input type="number" class="form-control form-control-lg" name="emi_month" placeholder="Enter the EMI Month" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->emi_month }}@endif">
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="required">EMI Due</label>
                                    <input type="text" class="form-control form-control-lg" name="emi_due" placeholder="Enter the EMI Due" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->emi_due }}@endif">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="required">Premium Paying Term</label>
                                    <input type="number" class="form-control form-control-lg" name="premium_term" placeholder="Enter the Premium Paying Term" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->premium_paying_term }}@endif">
                                </div>
                              
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">Policy Term (Total Coverage)</label>
                                    <input type="text" class="form-control form-control-lg" name="policy_term" placeholder="Enter the Policy Term (Total Coverage)" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->policy_term }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Gross Premium  (With GST)</label>
                                    <input type="text" class="form-control form-control-lg" name="gross_premium" placeholder="Enter the Gross Premium  (With GST)" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->gross_premium }}@endif">
                                </div>
                                
                            </div>

                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required">Net Premium</label>
                                    <input type="text" class="form-control form-control-lg" name="net_premium" placeholder="Enter the Net Premium" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->net_premium }}@endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Policy No</label>
                                    <input type="text" class="form-control form-control-lg" name="policy_no" placeholder="Enter the Policy No" aria-label="Staff Name" value="@if(isset($insurance)){{ $insurance->policy_no }}@endif">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleFormControlSelect1">Policy Type</label>
                                  <select class="form-control form-control-lg" id="insurance_type" name="insurance_type">
                                    <option value="">------Choose Option------</option>
                                    <option value="1"  @if(isset($healthinsurance))@if($healthinsurance->insurance_type==1) {{ "selected" }} @endif @endif>Individual</option>
                                    <option value="2"  @if(isset($healthinsurance))@if($healthinsurance->insurance_type==1) {{ "selected" }} @endif @endif>Floater Policy</option>
                                  </select>
                            </div>
                            <div class="form-group health">
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
						     <label>Insurance Starting Date</label>
						     <input type="text" class="form-control form-control-lg" name="insurance_starting_date" value="@if(isset($healthinsurance)){{ $healthinsurance->insurance_starting_date }} @endif">
						    </div>
							<div class="form-group">
						     <label>Insurance Renewal Date</label>
						     <input type="text" class="form-control form-control-lg" name="insurance_renewal_date" value="@if(isset($healthinsurance)){{ $healthinsurance->insurance_renewal_date }} @endif">
						    </div>
                            <div class="form-group">
                              <label>Remarks</label>
                              <input type="text" class="form-control form-control-lg" name="remarks" placeholder="Enter Remarks" aria-label="remarks" value="@if(isset($healthinsurance)){{ $healthinsurance->remarks }} @endif">
                            </div> -->
                       
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
                plan_name: {
                    required: true
                },
                sum_assumed: {
                  required: true,
                  digits: true
                },
                emi: {
                    required: true,
                    digits: true
                },
                emi_due: {
                    required: true,
                    digits: true
                },
                emi_month: {
                    required: true,
                    digits: true,
                    max: 12
                },
                premium_term: {
                    required: true,
                    digits: true,
                },
                policy_term: {
                    required: true,
                    digits: true,
                },
                gross_premium: {
                    required: true,
                    digits: true,
                },
                net_premium: {
                    required: true,
                    digits: true,
                },
                policy_no: {
                    required: true
                },
            },
            messages: {
                plan_name: "Plan Name is required",
                sum_assumed: {
                    required: "Sum Assumed is required",
                    digits: "Please Enter in digits"
                },
                emi: {
                    required: "EMI is required",
                    digits: "Please Enter in digits"
                },
                emi_month:{
                    required: "EMI Month is required",
                    digits: "Please Enter in digits"
                },
                emi_due:{
                    required: "EMI Month is required",
                    digits: "Please Enter in digits"
                },
                premium_term: {
                    required: "Premium Paying Term is required",
                    digits: "Please Enter in digits"
                },
                policy_term: {
                    required: "Policy Term (Total Coverage) is required",
                    digits: "Please Enter in digits"
                },
                gross_premium: {
                    required: "Gross Premium (With GST) is required",
                    digits: "Please Enter in digits"
                },
                net_premium:{
                    required: "Net Premium is required",
                    digits: "Please Enter in digits"
                }, 
                policy_no: "Policy No is required",
                
            }
        });
</script>
