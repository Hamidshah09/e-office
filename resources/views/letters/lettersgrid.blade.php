@extends('index')
@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Letters</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif      
    <form action="{{route('lettersgrid')}}" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="searchtype" id="" class="form-control">
                        <option value="id">Byid</option>
                        <option value="letter_no">By Letter No</option>
                        <option value="letter_date">By Letter Date</option>
                        <option value="dispatch_no">By Dispatch No</option>
                        <option value="dispatch_date">By Dispatch Date</option>
                        <option value="subject">By Subject</option>
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
            <th scope="col">Letter No</th>
            <th scope="col">Letter Date</th>
            <th scope="col">Dispatch No</th>
            <th scope="col">Dispatch Date</th>
            <th scope="col">Subject</th>
            <th scope="col">Addressed to</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($letters as $letter)
          <tr>
            <th scope="row">{{$letter->id}}</th>
            <td>{{$letter->letter_no}}</td>
            <td>{{$letter->letter_date}}</td>
            <td>{{$letter->dispatch_no}}</td>
            <td>{{$letter->dispatch_date}}</td>
            <td>{{$letter->subject}}</td>
            <td>{{$letter->designations}}</td>
            <td><a class="btn btn-primary" href="{{route('letteredit', $letter->id)}}">Edit</a></td>
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