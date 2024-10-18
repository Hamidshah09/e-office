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
                    {{-- <div class="col-sm-3 border">
                        
                    </div> --}}
                
                </div>
        
            </form>
            <button class="btn btn-primary" type="submit">Search</button>
            <button type="button" id="openModalBtn" class="btn btn-primary">Update Marking</button>
            <button type="button" id="openFileModalBtn" class="btn btn-primary">Set in File</button>
        </div>
    </div>
    <form action="{{route('inboxupdate')}}" method="post" id='inbox-grid'>
    @csrf
    <input type="hidden" value="" id= "form-type" name="form_type">
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
          <label for="">Marked to</label>
          <div class="custom-dropdown w-75">
              <input type="text" placeholder="Search.." id="myInput"/>
              <div id="myDropdown" class="custom-dropdown-content"></div>
          </div>
        </div>
    
    
    <div class="form-group my-3">
        <label for="">Designation</label>
        <select class="form-control w-75" name="addressee_id" id="designation_id">
          @foreach ($officers as $desig)
            <option value="{{$desig->id}}">{{$desig->designation}}</option>
          @endforeach
        </select>
    </div>
    <div class="modal-footer my-3">
      <button type="button" id="modal_close_btn" class="btn btn-secondary mx-3">Close</button>
      <button type="button" id="modal_save_btn" class="btn btn-primary">Save changes</button>
    </div>
    
  </div>
</div>
  {{-- File Modal --}}
<div id="filemodal" class="file-modal">
  <div class="file-modal-content">
    <h4>Select File</h4>
    <div class="row my-3">
      <div class="col">
        <input
          class="form-control"
          type="text"
          name="search"
          id="search"
        />
      </div>
      <div class="col">
        <select name="search-type" class="form-control" id="search-type">
          <option value="File_id">File ID</option>
          <option selected value="File_No">File No</option>
          <option value="Subject">Subject</option>
        </select>
      </div>
      <div class="col">
        <button class="btn btn-primary w-100" onclick="search()">
          Search
        </button>
      </div>
    </div>
    <div class="table-responsive h-50">
      <table class="table table-light table-hover" id="data-table">
        <thead class="table-dark">
          <tr>
            <th>File ID</th>
            <th>File No</th>
            <th>File Subject</th>
          </tr>
        </thead>
        <tbody id="table-body"></tbody>
      </table>
    </div>
    <div>
      <button class="btn btn-primary" id="selectFileBtn">
        Select File
      </button>
      <button class="btn btn-danger" id="closeBtn1">
        close
      </button>
    </div>
  </div>
</div>
{{-- end of file modal --}}

<script>
var files_data = @json($files);
// filemodal code 
var fileModal = document.getElementById("filemodal");
var openFileModalBtn = document.getElementById("openFileModalBtn");
openFileModalBtn.onclick = function(){
  fileModal.style.display = "block";
};
var selectFileBtn = document.getElementById("selectFileBtn");
var closeBtn1 = document.getElementById("closeBtn1");

selectFileBtn.onclick = function(){
  
  var selectedvalue = id;
  var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');
  
  checkedBoxes.forEach(element => {
    element.value = selectedvalue
      
  })
  close_modal();
  document.getElementById("form-type").value = "set_file";
  document.getElementById('inbox-grid').submit();

}



//marking code
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");
var savebtn = document.getElementById('modal_save_btn');
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var close_btn= document.getElementById('modal_close_btn');
var maincheck = document.getElementById('chkall');

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
function close_file_modal(){
  fileModal.style.display = "none";
}

// When the user clicks on the button, open the modal
btn.onclick = function() {
  if (document.querySelectorAll('input[type=checkbox]:checked').length==0){
    alert("Please Select letter by clicking on right side checkbox");
  }else{
    modal.style.display = "block";
  }
}

savebtn.onclick = function(){
  
  var selectedvalue = document.getElementById('designation_id');
  var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');
  
  checkedBoxes.forEach(element => {
    element.value = selectedvalue.value
      
  })
  close_modal()
  document.getElementById("form-type").value = "marked_to";
  document.getElementById('inbox-grid').submit();
}
// When the user clicks on <span> (x), close the modal
span.onclick = close_modal;
close_btn.onclick = close_modal;
closeBtn1.onclick = close_file_modal;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }else if(event.target == fileModal){
      fileModal.style.display = "none";
    }
}

  </script>
  <script>var officers = @json($officers);</script>
  <script src="{{ URL::asset('js/custom-searchbox.js'); }} "></script>
  <script src="{{ URL::asset('js/file-modal.js'); }} "></script>
@endsection