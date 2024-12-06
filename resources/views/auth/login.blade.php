@extends('master')
@section('content')
<div class="container">
    <h3 class="mt-3">Login</h3>
    <form action="{{route('authenticate')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div class="container">
        <a href="{{route('signup')}}">Don't have account?Please register.</a>
      </div>
</div>
@endsection