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
              <h3 class="page-title">Add Staff</h3>
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
					<form id="staff-form" action="{{ url('/admin/save-staff') }}" method="POST" enctype="multipart/form-data">@csrf
						@if(isset($user))
							<input type="hidden" name="hid" value="{{ $user->id }}"> 
						@endif
						<div class="form-group">
						  <label>Staff Name</label>
						  <input type="text" class="form-control form-control-lg" name="name" placeholder="Staff Name" aria-label="Staff Name" value="@if(isset($user)){{ $user->name }} @endif">
						</div>
						<div class="form-group">
						  <label>E-mail</label>
						  <input type="email" class="form-control form-control-lg" placeholder="E-mail" name="email" aria-label="E-mail" value="@if(isset($user)){{ $user->email }} @endif">
						</div>
						<div class="form-group">
						  <label>Mobile</label>
						  <input type="text" class="form-control form-control-lg"  name="mobile" placeholder="Mobile" aria-label="Mobile" value="@if(isset($user)){{ $user->mobile }} @endif">
						</div>
						<div class="form-group">
						  <label>Password</label>
						  <input type="text" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="Password" value="@if(isset($user)){{ $user->plain }} @endif">
						</div>
						<div class="form-group">
						  <label>Profile Image</label>
						  <input type="file" class="form-control form-control-lg" name="profile_image">
						</div>
						<div class="form-group">
						  <label for="exampleFormControlSelect1">Status</label>
						  <select class="form-control form-control-lg" id="status" name="status">
							<option value="">------Choose Option------</option>
							<option value="1" @if(isset($user))@if($user->status==1) {{ "selected" }} @endif @endif>Active</option>
							<option value="0"  @if(isset($user))@if($user->status==0) {{ "selected" }} @endif @endif>In-Active</option>
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
		 $('#staff-form').validate({ // initialize the plugin
			ignore: ".ignore",
			rules: {
				name: {
					required: true
				},
				email: {
				  required: true,
				  email: true
				},
				mobile: {
					required: true
				},
				password: {
					required: true
				},
				status: {
					required: true
				}
			}
		});
	</script>