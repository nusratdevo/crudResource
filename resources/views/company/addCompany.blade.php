@extends('layouts.master')

@section('title','Add Company')
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
                <div class="card-header"><h1>Add Company</h1></div>

                <div class="card-body">
                <form action="{{route('company.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">

                    <div class="form-group">
                        <label for="type">Name</label>
                        <input type="text" name="name" value="">
                    </div>
                       
                    <div class="form-group">
                        <label for="type">Email</label>
                        <input type="text" name="email" value="">
                    </div>
					<div class="form-group">
                        <label for="type">Website</label>
                        <input type="text" name="website" value="">
                    </div>
                    <div class="form-group">
                        <label for="type">LOGO</label>
                        <input type="file" name="image">
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
 