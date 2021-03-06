<?php use App\Models\Customers;
use Illuminate\Support\Str;

 ?>
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
				<form action="{{ url('admin/export-customerdetails') }}" method="post">@csrf
					<div class="row">
				   <div class="form-group col-md-3">
						  <select class="form-control form-control-lg form-select" id="insurance_type" name="insurance_type">
						   <option value="">----Choose the Insurance----</option>
							<option value="0" @if(isset($insurance))@if($insurance->insurance_type==1) {{ "selected" }} @endif @endif > All</option>
							<option value="1" @if(isset($insurance))@if($insurance->insurance_type==1) {{ "selected" }} @endif @endif >Health Insurance</option>
							<option value="2" @if(isset($insurance))@if($insurance->insurance_type==2) {{ "selected" }} @endif @endif >Motor Insurance</option>
							<option value="3" @if(isset($insurance))@if($insurance->insurance_type==3) {{ "selected" }} @endif @endif >Life Insurance</option>
						  </select>
					</div>
						<div class="form-group col-3">
						  <input type="date" class="form-control form-control-lg" name="start_date" placeholder="Start Date" aria-label="customerdetails">
						</div>
						<div class="form-group col-md-3">
						  <input type="date" class="form-control form-control-lg" placeholder="End Date" name="end_date" aria-label="exportcustomerdetails">
						</div>
						<div class="form-group col-md-3">
						  <input type="submit" class="p-3 btn btn-outline-success btn-fw" value="Download">
						</div>
					</div>
					<input type="hidden" value="{{  $cid }}" name="cid" />
				</form>	
            <div class="row">
				<!-- <div style="width:10%;margin-left: 84%;">
					<a href="{{ url('admin/add-customerdetails') }}" class="p-3 btn btn-outline-success btn-fw">Add customer</a>
				</div> -->
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
							<th>Staff name</th>
                            <th> Name </th>
                            <th> Mobile </th>
                            <th> E-mail </th>
<!-- 							<th> Country </th>
 -->                            <th> State </th>
							 <th> City </th>
<!-- 							<th> Address </th>
 -->                            <th> Status </th>
							<th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
			
							@foreach($customers as $customersval)
							  
							  <tr>
								  <td>
									{{ $loop->iteration  }}
								  </td>
								  <td>{{ Customers::getstaffname($customersval->staff_id) }}</td>
								  <td>
									{{ $customersval->first_name }}
								  </td>
								  <td>
									{{ $customersval->mobile }}
								  </td>
                                   <td>
									{{ $customersval->email }}
								  </td>
                                 
								 <!--  <td>
									@if($customersval->country==1)
									<label> India </label>
								     @endif
								  </td> -->

								  <td>
								  	{{ strtolower($customersval->state_name) }}
								  </td>
								  <td>
									{{ $customersval->city }}
								  </td>
								 <!--  <td>
									{{ $customersval->address }}
								  </td> -->
                                  <td>
									@if($customersval->status==1)
										<label class="badge badge-success">Active</label>
									@else($customersval->status == '0')
										<label class="badge badge-danger">In-Active</label>
									@endif
								  </td>
								  <td>
									<!-- <a href="{{ url('/admin/edit-customerdetails/'.$customersval->id) }}"><label class="badge badge-info">View</label></a> -->

									<a  class="badge badge-info linkdec" href="{{ url('/customer/view-customer/'.$customersval->id) }}">View</a>

									<a class="badge badge-danger linkdec" href="{{ url('/admin/delete-customerdetails/'.$customersval->id) }}">Delete</a>
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