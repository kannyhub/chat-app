@extends('master')
@section('content')
<h3 class="my-3">
    Users
</h3>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Email</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @php
            $sr = 1;
        @endphp
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $sr }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{route('user.view',$user->id)}}" class="btn btn-success btn-sm mx-2">View</a><button class="btn btn-primary btn-sm mx-2">Edit</button><button class="btn btn-danger btn-sm mx-2">Delete</button></td>
            </tr>
            @php
                $sr = $sr+1;
            @endphp
        @endforeach
    </tbody>
  </table>
@endsection