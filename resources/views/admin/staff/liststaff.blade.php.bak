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
                </ol>
              </nav>
            </div>
			
			
			
            <div class="row">
            	<div class="col-6">
              	<form action="{{ url('admin/export-staff') }}" method="post">
              		@csrf
									<div class="form-group col-md-6">
						  			<input type="submit" class="p-3 btn btn-outline-success btn-fw" value="Download Staff">
									</div>
								</form>		
							</div>

							<div class="form-group col-6" >
										<a style="float:right;" href="{{ url('admin/add-staff') }}" class="p-3 btn btn-outline-success btn-fw">Add Staff</a>
							</div>	
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
<!-- 							<th> Image </th>
 -->                            <th> Mobile </th>
                            <th> E-mail </th>
                            <th> Status </th>
							<th> Edit </th>
							<th> Delete </th>
                          </tr>
                        </thead>
                        <tbody>
						@if($user->isNotEmpty($user))
							
							@foreach($user as $userval)
							  <tr>
								  <td>
									{{ ($loop->index + 1) }}
								  </td>
								  <td>
									{{ $userval->name }}
								  </td>

							<!-- 	<td>
								
								  <img src="{{ asset('storage/profile/'.$userval->profile_image) }}" class="rounded-circle">
								</td> -->
								  <td>
									{{ $userval->mobile }}
								  </td>

								  <td>
									{{ $userval->email }}
								  </td>

								  <td>
									@if($userval->status==1)
										<label class="badge badge-success">Active</label>
									@else($userval->status == '0')
										<label class="badge badge-danger">In-Active</label>
									@endif
								  </td>
								  <td>
									<a class="badge badge-info linkdec" href="{{ url('/admin/edit-staff/'.$userval->id) }}">Edit</a>
								  </td>
		                            <td>
									<a class="badge badge-danger linkdec" href="{{ url('/admin/list-customerdetails/'.$userval->id) }}">View Customers</a>
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