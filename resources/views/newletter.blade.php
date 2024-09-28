@extends('index')
@section('content')
<div class="container fluid">
    {{-- <div class="card-body"><div class="align-items-center row"><div class="col"><h6 class="text-uppercase text-body-secondary mb-2">Value</h6><span class="h2 mb-0">$24,500</span><span class="mt-n1 ms-2 badge text-bg-success-subtle">+3.5%</span></div><div class="col-auto"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-body-secondary"><g><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></g></svg></div></div></div> --}}
    <form action="">
    <h4 class="font-strong mt-4">New Letter Received</h5>
    <h5 class="font-strong my-3 heading-tab">Sender Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Name</label>
          <input type="text" id="sender_name" name="sender_name" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Designation </label>
          <input type="text" id="sender_desig" name="sender_desig" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Sender Address </label>
          <input type="text" id="sender_address" name="sender_address" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
    </div>
    <h5 class="font-strong my-3 heading-tab">Addressee Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Search Officer</label>
          <div class="custom-dropdown">
            <input type="text" placeholder="Search.." id="myInput"/>
            <div id="myDropdown" class="custom-dropdown-content">
            </div>
            <input type="hidden" name="addressee_id">
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Addressed to</label>
          <input type="text" id="addressee_name" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Designation</label>
          <input type="text" id="addressee_desig" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
    </div>
    <h5 class="font-strong my-3 heading-tab">Letter Information</h5>
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Letter No</label>
          <input type="text" id="letter_no" name="letter_no" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="">Letter Date </label>
          <input type="text" id="letter_date" name="letter_date" value="" class="form-control" minlength="3" maxlength="60" required="required">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="">Letter Subject </label>
          <input type="text" id="letter_subject" name="letter_subject" value="" class="form-control" minlength="3" maxlength="60" required="required">
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
  </div>
@endsection