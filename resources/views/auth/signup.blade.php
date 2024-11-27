@extends('master')
@section('content')
<div class="container">
    <h3 class="mt-3">Signup</h3>
    @error('message')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form action="{{ route('register') }} " method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Room Name</label>
            <input type="text" class="form-control" name="room_name" id="" aria-describedby="emailHelp">
        </div>
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
        <a href="{{route('login')}}">Already have account?Please login.</a>
      </div>
</div>
@endsection