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
                  <li class="breadcrumb-item"><a href="#">List Staff</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Staff</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
					<form method="post">
						<div class="form-group">
						  <label>Staff Name</label>
						  <input type="text" class="form-control form-control-lg" name="name" placeholder="Staff Name" aria-label="Staff Name">
						</div>
						<div class="form-group">
						  <label>E-mail</label>
						  <input type="text" class="form-control form-control-lg" placeholder="E-mail" name="email" aria-label="E-mail">
						</div>
						<div class="form-group">
						  <label>Mobile</label>
						  <input type="text" class="form-control form-control-lg" name="mobile" placeholder="Mobile" aria-label="Mobile">
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