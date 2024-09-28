@extends('index')
@section('content')
<div class="container fluid">
    {{-- <div class="card-body"><div class="align-items-center row"><div class="col"><h6 class="text-uppercase text-body-secondary mb-2">Value</h6><span class="h2 mb-0">$24,500</span><span class="mt-n1 ms-2 badge text-bg-success-subtle">+3.5%</span></div><div class="col-auto"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-body-secondary"><g><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></g></svg></div></div></div> --}}
  <form action="{{route('savenewofficer')}}" method="POST">
    @csrf
    <h4 class="font-strong heading-tab my-4">New Officer</h5>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label class="form-label" for="">Officer Name</label>
          <input type="text" id="addressee_name" name="addressee_name" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label class="form-label" for="">Officer Designation </label>
          <select name="designation_id" id="" class="form-control">
            @foreach ($designations as $desig)
                <option value="{{$desig->id}}">{{$desig->designation}}</option>    
            @endforeach
          </select>
        </div>
      </div>
      
      <div class="col-sm-4">
        <div class="form-group">
              <label class="form-label" for="">Status </label>
              <select name="status_id" id="" class="form-control">
                <option value="1" selected>Active</option>
                <option value="2">Deactive</option>
              </select>
        </div>
      </div>
      <div class="col-sm-4 my-3">
        <button type="submit" class="btn btn-primary">Save</button>  
      </div>
        
        
    </div>
  </form>
</div>
@endsection