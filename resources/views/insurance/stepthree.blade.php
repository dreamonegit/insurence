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

            <form id="step_two" action="{{ url('/insurance/save-insurance-type') }}" method="POST">
                @csrf

                  <div class="card">
                    <div class="card-header">Step 2: Insurance Type</div>
  
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
  
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Insurance Type</label>
                                      <select class="form-control form-control-lg" id="insurance_type" name="insurance_type">
                                        <option value="">------Choose Option------</option>
                                        <option value="1" @if(isset($insurance))@if($insurance->insurance_type==1) {{ "selected" }} @endif @endif >Health Insurance</option>
                                        <option value="2" @if(isset($insurance))@if($insurance->insurance_type==2) {{ "selected" }} @endif @endif >Motor Insurance</option>
    									<option value="3" @if(isset($insurance))@if($insurance->insurance_type==3) {{ "selected" }} @endif @endif >Life Insurance</option>
                                      </select>
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input type="text" class="form-control form-control-lg" name="first_name" placeholder="Enter the First name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->first_name }} @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name" placeholder="Enter the Last Name" aria-label="Staff Name" value="@if(isset($customers)){{ $customers->last_name }} @endif">
                                </div>
                            </div>
                         
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('addinsurence') }}" class="btn btn-danger pull-right ">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary step-button button-right">Next</button>
                            </div>
                        </div>
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

<script>
         $('#step_two').validate({ 
            ignore: ".ignore",
            rules: {
                insurance_type: {
                    required: true
                },        
            },
             messages: {
                insurance_type: "Insurance Type is required",
            }
        });
    </script>