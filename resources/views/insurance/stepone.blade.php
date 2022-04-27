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

            <form action="{{ url('/admin/save-customerdetails') }}" method="POST">
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
                          <input type="text" class="form-control form-control-lg" name="country" placeholder="Enter the Country" aria-label="Country" value="@if(isset($customers)){{ $customers->country }} @endif">
                        </div>
                        <div class="form-group">
                          <label>State</label>
                          <input type="text" class="form-control form-control-lg" name="state" placeholder="Enter the State" aria-label="State" value="@if(isset($customers)){{ $customers->state }} @endif">
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
                      
                          
                    </div>
  
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Next</button>
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

