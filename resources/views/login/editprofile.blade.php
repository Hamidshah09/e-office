@extends('index')
@section('content')
<div class="container fluid">
    {{-- <div class="card-body"><div class="align-items-center row"><div class="col"><h6 class="text-uppercase text-body-secondary mb-2">Value</h6><span class="h2 mb-0">$24,500</span><span class="mt-n1 ms-2 badge text-bg-success-subtle">+3.5%</span></div><div class="col-auto"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-body-secondary"><g><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></g></svg></div></div></div> --}}
    
  <form action="{{route('', $user->id)}}" method="POST">
    @csrf
    @method('PUT')
    <h4 class="font-strong heading-tab my-4">Update Profile</h5>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value={{$user->name}}>         
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value={{$user->name}}>         
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">         
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">         
        </div>
      </div>
      <div class="col-sm-4 my-3">
        <button type="submit" class="btn btn-primary">Update</button>  
      </div>
      <div class="col-sm-4 my-3">
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