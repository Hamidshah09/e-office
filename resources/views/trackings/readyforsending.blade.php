@extends('index')
@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">{{$title}}</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif
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
    <div class="row">      
        <div class="col-sm border">
            <form action="" method="GET" class="border">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select name="searchtype" id="" class="form-control">
                                <option value="marked_to" selected>Market To</option>
                                <option value="letter_no" >By Letter No</option>
                                <option value="letter_date">By Letter Date</option>
                                <option value="dispatch_no" >By Dispatch No</option>
                                <option value="dispatch_date">By Dispatch Date</option>
                                <option value="subject">In Subject</option>
                                <option value="id">By Letter Id</option>
                                <option value="send_by">Send By</option>

                            </select>
                        </div> 
                    </div>
                    <div class="col-sm-3 border">
                      <button class="btn btn-primary" type="submit">Search</button>    
                    </div>
                
                </div>
                
            </form>
            
            <button  class="btn btn-info my-2" id="send_concerned">Sent to Concerned</button>
            <button type="button" id="openModalBtn" class="btn btn-info">Sent to anyone</button>
        </div>
    </div>
    <form action="{{route('send_concerned')}}" method="post" id='inbox-grid'>
    @csrf
    <table class="table table-bordered table-striped my-3">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Letter No</th>
            <th scope="col">Letter Date</th>
            <th scope="col">Subject</th>
            <th scope="col">Marked to</th>
            <th scope="col">PA</th>
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
            <td><input class="form-check-input" type="checkbox" name="chk{{$data->id}}" value="{{$data->pa_id}}"></td>
            {{-- <td>
                <a style="font-size: 24px" href=""><i class='bx bx-add-to-queue'></i></a>
                <a style="font-size: 24px" href=""><i class='bx bx-chevron-right-square'></i></a>
                <a style="font-size: 24px" href=""><i class='bx bxs-chevrons-right'></i></a>
            </td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
    </form>  
  </div>
  {{-- model dialog --}}
  <!-- The Modal -->
  <!-- Button trigger modal -->


<!-- Modal -->
<div id="myModal" class="marking-modal">
  <div class="marking-modal-content">
      <span class="close">&times;</span>
        <div class="form-group">
          <h5>Send Letter to selected</h5>
        </div>
    
    
    <div class="form-group my-3">
        <label for="">PA to Officer</label>
        <select class="form-control w-75" name="addressee_id" id="designation_id">
          @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
        </select>
    </div>
    <div class="modal-footer my-3">
      <button type="button" id="modal_close_btn" class="btn btn-secondary mx-3">Close</button>
      <button type="button" id="modal_save_btn" class="btn btn-primary">Save changes</button>
    </div>
    
  </div>

  <script>
    // function submit_form(){
    //   form_type = document.getElementById('form_type');
      
    //   if (btn_type=='send-btn'){
    //     form_type.value = 'send_btn';
    //   }else{
    //     form_type.value = 'marked_btn';
    //   }
    //   console.log(document.getElementById('form_type').value);
      // prevent_defualt();
    //     document.getElementById('inbox-grid').submit();
    // }

    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");
var savebtn = document.getElementById('modal_save_btn');
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var close_btn= document.getElementById('modal_close_btn');
var maincheck = document.getElementById('chkall');
var send_concerned = document.getElementById('send_concerned');
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

  function close_modal() {
    modal.style.display = "none";
}

// When the user clicks on the button, open the modal
btn.onclick = function() {
  var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');
    if(checkedBoxes.length==0){
      alert("Please click on right side checkbox to select a letter")
    }else{
      modal.style.display = "block";
    }
}
send_concerned.onclick = function(){
  var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');
  if(checkedBoxes.length==0){
      alert("Please click on right side checkbox to select a letter")
    }else{
      document.getElementById('inbox-grid').submit();
    }
  
}
savebtn.onclick = function(){
  var selectedvalue = document.getElementById('designation_id');
  checkedBoxes.forEach(element => {
      element.value = selectedvalue.value
  })
  close_modal()
  document.getElementById('inbox-grid').submit();
}
// When the user clicks on <span> (x), close the modal
span.onclick = close_modal;
close_btn.onclick = close_modal;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

    
  </script>
  
@endsection