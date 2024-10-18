@extends('index')
@section('content')
<h5 class="font-strong my-3 heading-tab">Dashboard</h5>
<div class="alert alert-info">{{$user->name}} with id {{$user->id}} Loged In</div>
@endsection