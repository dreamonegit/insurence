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

            <form id="customerdetails-form" action="{{ url('/insurance/save-customerdetails') }}" method="POST">
                @csrf
  
                <div class="card">
                    <div class="card-header">Step 1: Basic Info</div>
  
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
                              <label>First Name</label>
                              <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Last Name</label>
                              <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                              <label>E-mail</label>
                              <input type="email" class="form-control form-control-lg" placeholder="Enter the E-mail" name="email" aria-label="E-mail" value="@if(isset($customers)){{ $customers->email }} @endif">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Mobile</label>
                              <input type="number" class="form-control form-control-lg"  name="mobile" placeholder="Enter the Mobile" aria-label="Mobile" value="@if(isset($customers)){{ $customers->mobile }} @endif">
                            </div>
                        </div>

                        <div class="row">
    						 <div class="form-group col-md-6">
        						<label>Country</label>
        			           <select class="form-control form-control-lg" id="countries" name="country">
        				        <option value="">---Choose the Country ---</option>
        						  <option value="1" @if(isset($customers))@if($customers->country==1) {{ "selected" }} @endif @endif>India</option>
        						  </select>
    						</div>
    	                     <div class="form-group col-md-6">
        						  <label>State</label>
        						  <select class="form-control form-control-lg" id="state" name="state">
        						  <option value="">---choose the State ---</option>
        						    @foreach($state as $statesvalue)
        						   <option value="{{ $statesvalue->StateID}}" @if(isset($customers))@if($customers->state==$statesvalue->StateID) {{ "selected" }} @endif @endif>{{ $statesvalue->StateName }} </option>
        						   @endforeach
        						  </select>
        						</div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label>City</label>
                              <input type="text" class="form-control form-control-lg" name="city" placeholder="Enter the City" aria-label="City" value="@if(isset($customers)){{ $customers->city }} @endif">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Address</label>
                              <input type="text" class="form-control form-control-lg" name="address" placeholder="Enter the Address" aria-label="Address" value="@if(isset($customers)){{ $customers->address }} @endif">
                            </div>
                        </div>
                  <!--       <div class="form-group">
                          <label for="exampleFormControlSelect1">Status</label>
                          <select class="form-control form-control-lg" id="status" name="status">
                            <option value="">------Choose Option------</option>
                            <option value="1" @if(isset($customers))@if($customers->status==1) {{ "selected" }} @endif @endif>Active</option>
                            <option value="0"  @if(isset($customers))@if($customers->status==0) {{ "selected" }} @endif @endif>In-Active</option>
                          </select>
                        </div>
                       -->
                          
                    </div>
  
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary button-right step-button">Next</button>
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
         $('#customerdetails-form').validate({ // initialize the plugin
            ignore: ".ignore",
            rules: {
                first_name: {
                    required: true
                },
                email: {
                  required: true,
                  email: true
                },
                mobile: {
                    required: true,
                    
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                status: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },
            },
            messages: {
                first_name: "First Name is required",
                email: "Email is required",
                address: "Address is required",
                mobile: "Mobile Number required",
                city: "City is required",
                
            }
        });
    </script>
