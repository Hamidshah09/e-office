@extends('index')
@section('content')
<div class="container d-flex justify-content-center align-items-center mt-5">
    <form class="w-50" action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">New Role</h5>
            </div>
            <div class="card-body">
                <div class="form-group my-2">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-control">         
                </div>
            
                <div class="clear-fix">
                    <button type="submit" class="btn btn-primary float-start"> Save</button>
                    
                    <a href="{{route('roles.index')}}" class="btn btn-secondary float-end"> Back</a>
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