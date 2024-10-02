@extends('index')
@section('content')
<div class="container d-flex justify-content-center align-items-center mt-5">
    <form class="w-50" action="{{route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update User</h5>
            </div>
            <div class="card-body">
                <div class="form-group my-2">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value={{$user->name}}>         
                </div>

                <div class="form-group my-2">
                    <label class="form-label">Login ID</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}">         
                </div>

                <div class="form-group my-2">
                    <label class="form-label">Role</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $role)
                            @if ($user->role_id==$role->id)
                                <option selected value="{{$role->id}}"> {{$role->role}}</option>    
                            @else
                                <option value="{{$role->id}}"> {{$role->role}}</option>        
                            @endif    
                        
                        @endforeach
                    </select>
                </div>

                <div class="form-group my-2">
                    <label class="form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        
                            @if ($user->status=='Active')
                                <option selected value="Active"> Active</option>
                                <option value="Deactive"> Deactive</option>        
                            @else
                                <option value="Active"> Active</option>
                                <option selected value="Deactive"> Deactive</option>        
                            @endif    
                    </select>
                    
                </div>

                <div class="form-group my-2">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">         
                </div>

                <div class="form-group my-2">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">         
                </div>
            
                <div class="clear-fix">
                    <button type="submit" class="btn btn-primary float-start"> Update</button>
                    
                    <a href="{{route('users.index')}}" class="btn btn-secondary float-end"> Back</a>
                </div>
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
        </div>
    </form>
</div>
@endsection