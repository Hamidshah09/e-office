@extends('index')

@section('content')
<div class="container fluid">
    <h5 class="font-strong my-3 heading-tab">Files</h5>
    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}    
      </div>
    @endif      
    <form action="{{route('files.index')}}" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="searchtype" id="" class="form-control">
                        <option value="file_no" selected>File No</option>
                        <option value="id">Byid</option>
                        <option value="file_subject">File  Subject</option>
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
            <th scope="col">File No</th>
            <th scope="col">File Subject</th>
            <th scope="col">Author</th>
            <th scope="col">Created on</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($files as $file)
          <tr>
            <th scope="row">{{$file->id}}</th>
            <td>{{$file->file_no}}</td>
            <td>{{$file->file_subject}}</td>
            <td>{{$file->name}}</td>
            <td>{{$file->created_at}}</td>
            <td>
                <a class="btn btn-info" href="{{route('files.show', $file->id)}}">View</a>
                @if ($file->author_id == $user_id)
                    <a class="btn btn-primary" href="{{route('files.edit', $file->id)}}">Edit</a>    
                @endif
                
            </td>
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