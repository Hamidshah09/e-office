@extends('index')
@section('content')
<div class="container fluid">
  <h4 class="font-strong mx-2">Edit Letter</h4>
  <form action="{{route('letterupdate', $letter->l_id)}}" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-sm-6"> {{-- main column 1 start --}}
      <h5 class="font-strong heading-tab mt-1">Sender Information</h5>
      <div class="row mt-2">
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Sender Name</label>
                  <input type="hidden" name="sender_id" value="{{$letter->s_id}}">
                  <input type="text" id="sender_name" name="sender_name" value="{{$letter->sender_name}}" class="form-control">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Sender Designation </label>
                  <input type="text" id="sender_designation" name="sender_designation" value="{{$letter->sender_designation}}" class="form-control">
              </div>
          </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="form-group">
              <label for="">Sender Address </label>
              <input type="text" id="sender_address" name="sender_address" value="{{$letter->sender_address}}" class="form-control" minlength="3" maxlength="60">
          </div>
        </div>
      </div> 
      <h5 class="font-strong my-3 heading-tab">Addressee Information</h5>
  
      @csrf
      <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Addressed to</label>
                  <div class="custom-dropdown">
                      <input type="text" id="myInput" placeholder="{{$letter->addressee_name}}"/>
                      <div id="myDropdown" class="custom-dropdown-content">
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Designation</label>
                  <select class="form-control" name="addressee_id" id="designation_id">
                      @foreach ($designations as $desig)
                          @if ($desig->id==$letter->designation_id)
                          <option selected value="{{$desig->id}}">{{$desig->designation}}</option>    
                          @else
                          <option value="{{$desig->id}}">{{$desig->designation}}</option>    
                          @endif
                      @endforeach
                  </select>
              </div>
          </div>
      </div> 
      <h5 class="font-strong my-3 heading-tab">Letter Information</h5>
      <div class="row mt-2">{{-- row 1 start --}}
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Letter No</label>
                  <input type="text" id="letter_no" name="letter_no" value="{{$letter->letter_no}}" class="form-control">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Letter Date </label>
                  <input type="text" id="letter_date" name="letter_date" value="{{$letter->letter_date}}" class="form-control">
              </div>
          </div>
      </div>{{-- row 1 end --}}
      <div class="row mt-2"> {{-- row 2 start --}}
          <div class="col-sm-12">
              <div class="form-group">
                  <label for="">Letter Subject </label>
                  <input type="text" id="letter_subject" name="subject" value="{{$letter->subject}}" class="form-control">
              </div>
          </div>
      </div> {{-- row 2 end --}}
      <div class="row mt-2"> {{-- row 3 start --}}
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Dispatch No.</label>
                  <input type="text" id="dispatch_no" name="dispatch_no" value="{{$letter->dispatch_no}}" class="form-control">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Dispatch Date </label>
                  <input type="text" id="dispatch_date" name="dispatch_date" value="{{$letter->dispatch_date}}" class="form-control">
              </div>
          </div>
      </div> {{-- row 3 end --}}
      <div class="row mt-2"> {{-- row 4 start --}}
          <div class="col-sm-12">
              <div class="form-group">
                <label for="">Remarks </label>
                <input type="text" id="remarks" name="remarks" value="{{$letter->remarks}}" class="form-control">
              </div>
          </div>
      </div> {{-- row 4 end --}}
      <div class="row mt-2"> {{-- row 4 start --}}
          <div class="col-sm-6">
              <div class="form-group">
                <label for="">Scaned Letter</label>
                <input type="file" id="dispatch_no" name="scan_file" value="" class="form-control">
              </div>
          </div>
          <div class="col-sm-6">
            <div class="d-flex flex-row justify-content-end align-items-end my-2">
              <button type="button" class="btn btn-outline-danger mx-3">Cancel</button>
              <button type="submit" class="btn btn-primary mr-3">Update</button>
            </div>
          </div>
      </div> {{-- row 4 end --}}
      <div class="row">
          <div>
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
  
      </div>
      <div class="col-sm-6"> {{-- main column 2 start --}}
          <h5 class="font-strong heading-tab mt-1">Letter Image</h5>
          <div class="form-group">
            <img class="img-fluid w-100" src="{{asset('/storage/'.$letter->scan_path)}}" alt="letter image">
          </div>
      </div>
  </div>
  </form>      
  
  
</div>  
<script>var officers = @json($officers);</script>
<script src="{{ URL::asset('js/custom-searchbox.js'); }} "></script>
@endsection