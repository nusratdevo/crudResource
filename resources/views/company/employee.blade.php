
@extends('layouts.master')

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
                <div class="card-header"><h1>Employee List</h1>
					<a href="{{route('company.index')}}" type="button" class="btn btn-primary float-end" >Company List</a>
					{{-- //logout --}}
					<form method="POST" action="{{ route('logout') }}">
						@csrf

						<x-dropdown-link :href="route('logout')"
								onclick="event.preventDefault();
											this.closest('form').submit();">
							{{ __('Log Out') }}
						</x-dropdown-link>
					</form>
				</div>
                <div>
                    <a href="{{ route('employee.create') }}" type="button" class="btn btn-success float-end margin-right:10px;">Create Employee</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-inverse">
                        <thead class="thead-inverse">
                            <tr>
                                <th>No</th>
                                <th>FistName</th>
                                <th>Last Name</th>
                                 <th>Email</th>
								 <th>Phone</th>
                                 <th>Company</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $item)
                                <tr>
									<td>{{$item->id}}</td>
                                    <td>{{ $item->firstname }}</td>
                                    <td>{{ $item->lastname }}</td>
                                    <td>{{ $item->email}}</td>
                                    <td>{{ $item->phone}}</td>
									<td>
										{{ $item->name}}
									</td>
                                    <td>
                                        <a href="{{ route('employee.edit',$item->id) }}" class="btn btn-info">Edit</a> 
                                        |<form action="{{ route('employee.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        {{-- <a href="{{ route('employee.destroy',$item->id) }}">DELETE</a>  --}}
                                        
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 