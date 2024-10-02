@extends('index')
@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Roles</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif      
    
    <table class="table table-bordered table-striped my-3">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr>
            <th scope="row">{{$role->id}}</th>
            <td>{{$role->role}}</td>
            <td><a class="btn btn-primary" href="{{route('roles.edit', $role->id)}}">Edit</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @if ($errors->any())
            <div class="card-footer text-body-secondary">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
  </div>

@endsection