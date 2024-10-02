@extends('index')
@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Users</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif      
    <form action="" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="searchtype" id="" class="form-control">
                        <option value="name" selected>ByName</option>
                        <option value="id">Byid</option>
                        <option value="email">Byemail</option>
                    </select>
                </div> 
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    
    </form>
    <table class="table table-bordered table-striped my-3">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->status}}</td>
            <td>{{$user->role}}</td>
            <td><a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a></td>
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