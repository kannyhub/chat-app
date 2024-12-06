@extends('master')
@section('content')
<div class="container">
    <h3 class="mt-3">Create Room</h3>
    @error('message')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form action="{{ route('room.store') }} " method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Room Name</label>
            <input type="text" class="form-control" name="name" id="" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Limit</label>
          <input type="text" class="form-control" name="limit" id="" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection