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
              <h3 class="page-title">Add customer details</h3>
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
              <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
					<form id="customerdetails-form" action="{{ url('/admin/save-customerdetails') }}" method="POST" enctype="multipart/form-data">@csrf
						@if(isset($customers))
						<input type="hidden" name="hid" value="{{ $customers->id }}"> 	
						@endif
						<div class="form-group">
						  <label>First Name</label>
						  <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
						</div>
						<div class="form-group">
						  <label>Last Name</label>
						  <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
						</div>
						<div class="form-group">
						  <label>E-mail</label>
						  <input type="email" class="form-control form-control-lg" placeholder="Enter the E-mail" name="email" aria-label="E-mail" value="@if(isset($customers)){{ $customers->email }} @endif">
						</div>
						<div class="form-group">
						  <label>Mobile</label>
						  <input type="text" class="form-control form-control-lg"  name="mobile" placeholder="Enter the Mobile" aria-label="Mobile" value="@if(isset($customers)){{ $customers->mobile }} @endif">
						</div>
						<div class="form-group">
						<label>Country</label>
			           <select class="form-control form-control-lg" id="countries" name="country">
				        <option value="">---choose the Country ---</option>
						  <option value="1" @if(isset($customers))@if($customers->country==1) {{ "selected" }} @endif @endif>India</option>
						  </select>
						</div>
	                     <div class="form-group">
						  <label>State</label>
						  <select class="form-control form-control-lg" id="state" name="state">
						  <option value="">---choose the State ---</option>
						    @foreach($state as $statesvalue)
						   <option value="{{ $statesvalue->id}}" @if(isset($customers))@if($customers->state==$statesvalue->id) {{ "selected" }} @endif @endif>{{ $statesvalue->StateName }} </option>
						   @endforeach
						  </select>
						</div>
						<div class="form-group">
						  <label>City</label>
						  <input type="text" class="form-control form-control-lg" name="city" placeholder="Enter the City" aria-label="City" value="@if(isset($customers)){{ $customers->city }} @endif">
						</div>
						<div class="form-group">
						  <label>Address</label>
						  <input type="text" class="form-control form-control-lg" name="address" placeholder="Enter the Address" aria-label="Address" value="@if(isset($customers)){{ $customers->address }} @endif">
						</div>
						<div class="form-group">
						  <label for="exampleFormControlSelect1">Status</label>
						  <select class="form-control form-control-lg" id="status" name="status">
							<option value="">------Choose Option------</option>
							<option value="1" @if(isset($customers))@if($customers->status==1) {{ "selected" }} @endif @endif>Active</option>
							<option value="0"  @if(isset($customers))@if($customers->status==0) {{ "selected" }} @endif @endif>In-Active</option>
						  </select>
						</div>
						<div class="form-group">
						  <button type="submit" class="btn btn-outline-primary btn-fw" style="width:10%;margin-left: 84%;">Save</button>
						</div>
					</form>
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
				},
				status: {
					required: true
				}
			}
		});
	</script>