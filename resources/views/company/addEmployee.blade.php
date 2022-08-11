@extends('layouts.master')

@section('title','Add Employee')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				@if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if(Session::has('flash_message_success'))
   <div class="alert alert-sm alert-success alert-block" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      <strong>{!! session('flash_message_success') !!}</strong>
   </div>
   @endif
                <div class="card-header"><h1>Add Employee</h1></div>

                <div class="card-body">
                <form action="{{route('employee.store') }}" method="POST" >
                  @csrf
                  <div class="card-body">

                    <div class="form-group">
                        <label for="type">First Name</label>
                        <input type="text" name="firstname" value="">
                    </div>
                       
                    <div class="form-group">
                        <label for="type">Last Name</label>
                        <input type="text" name="lastname" value="">
                    </div>
					<div class="form-group">
                        <label for="type">Email</label>
                        <input type="email" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="type">Phone</label>
                        <input type="number" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="type">Company</label>
                        <select name="companyId" class="form-control">
                            <option value="0">Company</option>
                            @foreach($company as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>

  
                      <button type="submit" class="btn btn-primary">
                              <i class="fas fa-plus-circle"></i>
                              <span>Create</span>
                      </button>
  
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 