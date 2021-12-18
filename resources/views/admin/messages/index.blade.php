{{-- stile inline momentaneo --}}
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card messages d-flex flex-column justify-content-center">
                    <div class="card-header padding-card bg-dark-blue b-radius-header text-center">
                        <h2>I messaggi di {{$user['firstname']}}</h2>
                    </div>
                    <div class="card-body bg-light-blue b-radius-body d-flex flex-column justify-center box-card">
                        @if(count($messages) == 0)
                            <h2 style="text-align: center;">Non hai ricevuto ancora messaggi :(</h2>
                        @endif
                        @foreach ($messages as $message)
                        <div class="message-card">
                            <div class="message-header">
                                <h4>Da: {{$message['firstname']}} {{$message['lastname']}}</h4>
                                <h4>E-mail: <a href="mailto:{{$message['email']}}">{{$message['email']}}</a></h4>
                                <h5>Data ricezione: {{$message['format_date']}}</h5>
                            </div>
                            <div class="message-body">
                                <p>{{$message['text']}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@endsection

