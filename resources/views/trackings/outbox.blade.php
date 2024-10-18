@extends('index')
@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Outbox</h5>
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
                        <option value="letter_no" selected>By Letter No</option>
                        <option value="letter_date">By Letter Date</option>
                        <option value="dispatch_no" >By Dispatch No</option>
                        <option value="dispatch_date">By Dispatch Date</option>
                        <option value="subject">In Subject</option>
                        <option value="id">By Letter Id</option>
                        <option value="marked_to">Market To</option>
                        <option value="send_by">Market To</option>

                    </select>
                </div> 
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    
    </form>
    <button class="btn btn-primary" id ="submit_form">Receive Letter(s)</button>
    <form action="{{route('receive')}}" method="post" id="outbox-grid">
      @csrf
    <table class="table table-bordered table-striped my-3">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Letter No</th>
            <th scope="col">Letter Date</th>
            <th scope="col">Subject</th>
            <th scope="col">Marked to</th>
            <th scope="col">Sent By</th>
            <th scope="col">Sent on</th>
            <th scope="col">Status</th>
            <th scope="col"><input class="form-check-input" id = "chkall" type="checkbox" name="all" value="yes"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tracking_data as $data)
          <tr>
            <td>{{$data->letter_no}}</th>
            <td>{{$data->letter_date}}</td>
            <td>{{$data->subject}}</td>
            <td>{{$data->addressee_name}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->sent_on}}</td>
            <td>{{$data->tracking_status}}</td>
            <td><input class="form-check-input" type="checkbox" name="chk{{$data->id}}" value="{{$data->id}}"></td>
            {{-- <td><a class="btn btn-primary" href="">Edit</a></td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
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
  <script>
    var maincheck = document.getElementById('chkall');
    var submit_form = document.getElementById('submit_form');
    var allCheckBoxes = document.querySelectorAll('input[type=checkbox]');

    maincheck.onclick = function(){
  if (maincheck.checked ==true){
    allCheckBoxes.forEach(element => {
      element.checked = true;
    });
  }else{
    allCheckBoxes.forEach(element => {
      element.checked = false;
    });
  }
  
}
    submit_form.onclick = function(){
      var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');
      if(checkedBoxes.length==0){
          alert("Please click on right side checkbox to select a letter")
        }else{
          document.getElementById('outbox-grid').submit();
        }
  
      }
  </script>
@endsection