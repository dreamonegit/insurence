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
              <h3 class="page-title">My Profile</h3>
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
					<form id="staff-form" action="{{ url('/admin/myprofile') }}" method="POST" enctype="multipart/form-data">@csrf
						@if(isset($user))
							<input type="hidden" name="hid" value="{{ $user->id }}"> 
						@endif
						<div class="form-group">
						  <label class="required">Staff Name</label>
						  <input type="text" class="form-control form-control-lg" name="name" placeholder="Staff Name" aria-label="Staff Name" value="{{ auth::user()->name }}">
						</div>
						<div class="form-group">
						  <label class="required">E-mail</label>
						  <input type="text" required readonly="readonly" class="form-control form-control-lg" placeholder="E-mail" name="email" aria-label="E-mail" value="{{ auth::user()->email }}">
						</div>
						<div class="form-group">
						  <label class="required">Mobile</label>
						  <input type="text" class="form-control form-control-lg"  name="mobile" placeholder="Mobile" aria-label="Mobile" value="{{ auth::user()->mobile }}">
						</div>
						<div class="form-group">
						  <label class="required">Password</label>
						  <input type="text" class="form-control form-control-lg"  name="password" placeholder="Password" aria-label="Mobile" value="{{ auth::user()->plain }}">
						</div>
						<div class="form-group">
						  <label>Profile Image</label>
						  <input type="file" class="form-control form-control-lg" name="profile_image">
						</div>
						<div class="form-group">
						  <label for="exampleFormControlSelect1">Status</label>
						  <select class="form-control form-control-lg" id="status" name="status">
							<option value="">------Choose Option------</option>
							<option value="1"  @if(auth::user()->status==1) {{ "selected" }} @endif>Active</option>
							<option value="0"  @if(auth::user()->status==0) {{ "selected" }} @endif>In-Active</option>
						  </select>
						</div>
						<div class="form-group">
						  <button type="submit" class="btn btn-outline-primary btn-fw" style="width:10%;margin-left: 84%;">Update</button>
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