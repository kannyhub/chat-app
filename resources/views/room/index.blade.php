@extends('master')
@section('content')
    <div class="container mt-4">
        <a class="btn btn-primary my-3" href="{{ route('room.create') }}">Create Room</a>
        <div class="row">
            @if(count($rooms) > 0) 
                @foreach ($rooms as $room)
                    <div class="col-sm-4 my-3">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="{{ route('room.view',$room->id) }}" class="btn btn-primary">Join Room</a>
                        </div>
                        </div>
                    </div>
                @endforeach
            @else
                    <div class="col text-center"><h3>No Rooms Found.Please Create The First One.</h3></div>
            @endif
        </div>
    </div>
@endsection