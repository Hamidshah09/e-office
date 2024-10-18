@extends('index')
@section('content')
<div class="container fluid">
    {{-- <div class="card-body"><div class="align-items-center row"><div class="col"><h6 class="text-uppercase text-body-secondary mb-2">Value</h6><span class="h2 mb-0">$24,500</span><span class="mt-n1 ms-2 badge text-bg-success-subtle">+3.5%</span></div><div class="col-auto"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-body-secondary"><g><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></g></svg></div></div></div> --}}
    <form action="{{route('letterstore')}}" method="POST" enctype="multipart/form-data">
      @csrf
    <h4 class="font-strong mt-4">New Letter Received</h5>
    <h5 class="font-strong my-3 heading-tab">Sender Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Name</label>
          <input type="text" id="sender_name" name="sender_name" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Designation </label>
          <input type="text" id="sender_designation" name="sender_designation" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Address </label>
          <input type="text" id="sender_address" name="sender_address" value="" class="form-control" minlength="3" maxlength="60">
        </div>
      </div>
    </div>
    <h5 class="font-strong my-3 heading-tab">Addressee Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Addressed to</label>
          <div class="custom-dropdown">
            <input type="text" placeholder="Search.." id="myInput"/>
            <div id="myDropdown" class="custom-dropdown-content">
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Designation</label>
          <select class="form-control" name="addressee_id" id="designation_id">
            @foreach ($designations as $desig)
              <option value="{{$desig->id}}">{{$desig->designation}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <h5 class="font-strong my-3 heading-tab">Letter Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Letter No</label>
          <input type="text" id="letter_no" name="letter_no" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Letter Date </label>
          <input type="text" id="letter_date" name="letter_date" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="">Letter Subject </label>
          <input type="text" id="letter_subject" name="subject" value="" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Dispatch No.</label>
          <input type="text" id="dispatch_no" name="dispatch_no" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Dispatch Date </label>
          <input type="text" id="dispatch_date" name="dispatch_date" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="">Remarks </label>
          <input type="text" id="remarks" name="remarks" value="" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Scaned Letter</label>
          <input type="file" id="dispatch_no" name="scan_file" value="" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="d-flex justify-content-end my-2">
          <button type="button" class="btn btn-outline-danger mx-3">Cancel</button>
          <button type="submit" class="btn btn-primary mr-3">Save</button>
        </div>
      </div>
    </div>
    </form>
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
  <script>var officers = @json($officers);</script>
  <script src="{{ URL::asset('js/custom-searchbox.js'); }} "></script>
@endsection