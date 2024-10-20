@extends('index')

@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Officers</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif      
    <form action="{{route('officerssearch')}}" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="searchtype" id="" class="form-control">
                        <option value="name" selected>ByName</option>
                        <option value="id">Byid</option>
                        <option value="designation">Bydesignation</option>
                    </select>
                </div> 
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    
    </form>
    <table class="table table-bordered table-striped my-3">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Designation</th>
            <th scope="col">Status</th>
            <th scope="col">PA to Officer</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($officers as $officer)
          <tr>
            <th scope="row">{{$officer->id}}</th>
            <td>{{$officer->addressee_name}}</td>
            <td>{{$officer->designation}}</td>
            <td>{{$officer->name}}</td>
            <td>{{$officer->status}}</td>
            <td><a class="btn btn-primary" href="{{route('editofficer', $officer->id)}}">Edit</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
@endsection