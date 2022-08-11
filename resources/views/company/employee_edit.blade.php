@extends('layouts.master')

@section('title','Edit Company')
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
                <div class="card-header"><h1>Edit employee</h1></div>

                <div class="card-body">
                <form  method="POST" action="{{route('employee.update', $employee->id) }}">
                  @csrf
                @method('PUT')
            
  
                  <div class="card-body">

                    <div class="form-group">
                        <label for="type">First Name</label>
                        <input type="text" name="firstname" value="{{ $employee->firstname}}">
                    </div>
                    <div class="form-group">
                        <label for="type">Last Name</label>
                        <input type="text" name="lastname" value="{{ $employee->lastname}}">
                    </div>
                       
                    <div class="form-group">
                        <label for="type">Email</label>
                        <input type="email" name="email" value="{{ $employee->email }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Phone</label>
                        <input type="number" name="phone" value="{{ $employee->phone }}">
                    </div>
                    <div class="form-group">
                        <select name="companyId" class="form-control">
                            <option value="0">Company</option>
                            @foreach($companies as $val)
                        <option value="{{$val->id}}" @if($val->id==$employee->companyId) selected @endif>{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
  
                      <button type="submit" class="btn btn-primary">
                              <i class="fas fa-arrow-circle-up"></i>
                              <span>Update</span>
                      </button>
  
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 