@include('layouts.elements.admin.header') 
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      @include('layouts.elements.admin.nav') 
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.elements.admin.sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">View customer details</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
              </nav>
            </div>
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
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
					<form id="customerdetails-form" action="{{ url('/admin/save-customerdetails') }}" method="POST" enctype="multipart/form-data">@csrf
						@if(isset($customers))
						<input type="hidden" name="hid" value="{{ $customers->id }}"> 	
						@endif

						<div class="row">
							<div class="form-group col-md-6">
							  <label class="required">First Name</label>
							  <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
							</div>
							<div class="form-group col-md-6">
							  <label class="required">Last Name</label>
							  <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
							  <label class="required">E-mail</label>
							  <input type="email" class="form-control form-control-lg" placeholder="Enter the E-mail" name="email" aria-label="E-mail" value="@if(isset($customers)){{ $customers->email }} @endif">
							</div>
							<div class="form-group col-md-6">
							  <label class="required">Mobile</label>
							  <input type="text" class="form-control form-control-lg"  name="mobile" placeholder="Enter the Mobile" aria-label="Mobile" value="@if(isset($customers)){{ $customers->mobile }} @endif">
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6">
								<label class="required">Country</label>
					           <select class="form-control form-control-lg" id="countries" name="country">
						        <option value="">---choose the Country ---</option>
								  <option value="1" @if(isset($customers))@if($customers->country==1) {{ "selected" }} @endif @endif>India</option>
								  </select>
							</div>
		                     <div class="form-group col-md-6">
							  <label class="required">State</label>
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
							  <label class="required">City</label>
							  <input type="text" class="form-control form-control-lg" name="city" placeholder="Enter the City" aria-label="City" value="@if(isset($customers)){{ $customers->city }} @endif">
							</div>
							<div class="form-group col-md-6">
							  <label class="required">Address</label>
							  <input type="text" class="form-control form-control-lg" name="address" placeholder="Enter the Address" aria-label="Address" value="@if(isset($customers)){{ $customers->address }} @endif">
							</div>
						</div>
						<div class="form-group">
						  <button type="submit" class="btn btn-primary button-right step-button" >Update</button>
						</div>
					</form>
                  </div>
				  
                </div>
				
              </div>
            </div>

            <div class="page-header">
                <h3 class="page-title">View Insurance details</h3>
            </div>

            <div class="row">
              	<div class="col-md-12 grid-margin stretch-card">
                	<div class="card">
                  		<div class="card-body">

                  			<table class="table table-striped">
							    <thead>
							      <tr>
							        <th>Insurance Type</th>
							        <th>Policy Number</th>
									<th>Insurance Date</th>
									<th>Renewal Date</th>
							        <th>Actions</th>
							      </tr>
							    </thead>
							    <tbody>

							    	@foreach($get_insurance_details as $insurance_details)
							      <tr>
							        
							        @if($insurance_details['insurance_type'] =='1') 
							        		<td>Health Insurance</td>
							        @elseif($insurance_details['insurance_type'] =='2')   
							        		<td>Motor Insurance</td>
							        @else
							        		<td>Life Insurance</td>
							        @endif

      

							      
							        <td>@isset($insurance_details['policy_no']) {{ $insurance_details['policy_no'] }} @endif</td>
									<td>@isset($insurance_details['insurance_date']) {{ $insurance_details['insurance_date'] }} @endif</td>
									<td>@isset($insurance_details['insurance_expiry_date']) {{ $insurance_details['insurance_expiry_date'] }} @endif</td>
							        <td><a class="badge badge-info linkdec" href="{{ url('/insurance/edit-insurance/'.$insurance_details['id']) }}">Edit</a></td>
								  </tr>
							      @endforeach
							     
							    </tbody>
							  </table>

                  		</div>
              		</div>
          		</div>
      		</div>


          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
			@include('layouts.elements.admin.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
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
					required: true
				},
				address: {
					required: true
				},
				city: {
					required: true
				}
			}
		});
	</script>