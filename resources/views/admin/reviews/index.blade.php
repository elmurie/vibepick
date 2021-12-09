{{-- stile inline momentaneo!!! --}}
@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Ciao {{$user['firstname']}} {{$user['lastname']}} queste sono le tue recensioni</h2>
        @foreach ($reviews as $review)
            <div style="margin-bottom: 20px">
                <h3>{{$review['title']}}</h3>
                <h5>Votazione: {{$review['vote']}}</h5>
                <p  style="margin-bottom: 0">{{$review['content']}}</p>
                <small>Scritta il: {{$review['created_at']}}</small>
            </div>
        @endforeach
    </div>

@endsection