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
                <div class="card-header"><h1>Add Company</h1></div>

                <div class="card-body">
                <form  method="POST" action="{{route('company.update', $company->id) }}" enctype="multipart/form-data">
                  @csrf
                @method('PUT')
            
  
                  <div class="card-body">

                    <div class="form-group">
                        <label for="type">Name</label>
                        <input type="text" name="name" value="{{ $company->name}}">
                    </div>
                       
                    <div class="form-group">
                        <label for="type">Email</label>
                        <input type="text" name="email" value="{{ $company->email }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Website</label>
                        <input type="text" name="website" value="{{ $company->website }}">
                    </div>
                    <div class="form-group">
                        <label for="type">LOGO</label>
                        <input type="file" name="image">
                        @if(!empty($company->image))
                        <input type="hidden" name="current_image" value="{{ $company->image }}"> 
                        <img src="{{ asset($company->image) }}" style="width:250px;">
                        @endif
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
 