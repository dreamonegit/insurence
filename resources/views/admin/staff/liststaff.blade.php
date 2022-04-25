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
              <h3 class="page-title"> List Staff </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Staff</a></li>
                  <li class="breadcrumb-item active" aria-current="page">List Staff</li>
                </ol>
              </nav>
            </div>
            <div class="row">
				<div style="width:10%;margin-left: 84%;">
					<a href="{{ url('admin/add-staff') }}" class="p-3 btn btn-outline-success btn-fw">Add Staff</a>
				</div>
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
					@if (\Session::has('message'))
						<div class="alert alert-success">
							<ul>
								<li>{!! \Session::get('message') !!}</li>
							</ul>
						</div>
					@endif
                    <div class="table-responsive">
                      <table class="table" id="liststaffTable">
                        <thead>
                          <tr>
                            <th> ID </th>
                            <th> Name </th>
							<th> Image </th>
                            <th> Mobile </th>
                            <th> E-mail </th>
                            <th> Status </th>
							<th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
						@if($user->isNotEmpty($user))
							
							@foreach($user as $userval)
							  <tr>
								  <td>
									{{ $userval->id }}
								  </td>
								  <td>
									{{ $userval->name }}
								  </td>

								<td>
								
								  <img src="{{ asset('storage/profile/'.$userval->profile_image) }}" class="me-2" alt="image"> David Grey
								</td>
								  <td>
									{{ $userval->mobile }}
								  </td>

								  <td>
									{{ $userval->email }}
								  </td>

								  <td>
									@if($userval->status==0)
										<label class="badge badge-success">Active</label>
									@else
										<label class="badge badge-danger">In-Active</label>
									@endif
								  </td>
								  <td>
									<a href="{{ url('/admin/edit-staff/'.$userval->id) }}"><label class="badge badge-info">Edit</label></a>
								  </td>
							  </tr>
							@endforeach
						@endif
                        </tbody>
                      </table>
                    </div>
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