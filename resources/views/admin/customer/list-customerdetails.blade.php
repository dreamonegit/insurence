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
              <h3 class="page-title"> List customer details </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
              </nav>
            </div>
            <div class="row">
				<div style="width:10%;margin-left: 84%;">
					<a href="{{ url('admin/add-customerdetails') }}" class="p-3 btn btn-outline-success btn-fw">Add customer</a>
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
                            <th> Mobile </th>
                            <th> E-mail </th>
							<th> Country </th>
                            <th> State </th>
							 <th> City </th>
							<th> Address </th>
                            <th> Status </th>
							<th> Edit </th>
							<th> Delete </th>
                          </tr>
                        </thead>
                        <tbody>
			
							
							@foreach($customers as $customersval)
							  <tr>
								  <td>
									{{ $customersval->id }}
								  </td>
								  <td>
									{{ $customersval->first_name }}
								  </td>
								  <td>
									{{ $customersval->mobile }}
								  </td>
                                   <td>
									{{ $customersval->email }}
								  </td>
								  <td>
									{{ $customersval->country }}
								  </td>
								  <td>
									{{ $customersval->state }}
								  </td>
								  <td>
									{{ $customersval->city }}
								  </td>
								  <td>
									{{ $customersval->address }}
								  </td>
                                  <td>
									@if($customersval->status==1)
										<label class="badge badge-success">Active</label>
									@else($customersval->status == '0')
										<label class="badge badge-danger">In-Active</label>
									@endif
								  </td>
								  <td>
									<a href="{{ url('/admin/edit-customerdetails/'.$customersval->id) }}"><label class="badge badge-info">Edit</label></a>
								  </td>
		                            <td>
									<a href="{{ url('/admin/delete-customerdetails/'.$customersval->id) }}"><label class="badge badge-danger">Delete</label></a>
									</td>
							  </tr>
							@endforeach
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