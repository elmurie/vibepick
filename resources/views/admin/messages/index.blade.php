{{-- stile inline momentaneo --}}
@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Ciao {{$user['firstname']}} {{$user['lastname']}} questi sono i tuoi messaggi</h2>
        @foreach ($messages as $message)
            <div style="margin-bottom: 20px">
                <h4>Messaggio di: {{$message['firstname']}} {{$message['lastname']}}</h4>
                <h5>{{$message['email']}}</h5>
                <p style="margin-bottom: 0">{{$message['text']}}</p>
                <small>Ricevuto in data: {{$message['created_at']}}</small>
            </div>
        @endforeach
    </div>

@endsection

