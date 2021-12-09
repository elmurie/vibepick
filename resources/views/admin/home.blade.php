@extends('layouts.app')

@section('content')
    {{-- Questa è la Dashboard del singolo Utente Registrato --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <h2>Welcome to VibePick, {{$user['firstname']}}! </h2>
                        <ul>
                            {{-- ToDo questi devono diventare link per le varie sezioni del profilo --}}
                            <li><a href="#">Profilo personale</a></li>
                            <li><a href="http://127.0.0.1:8000/admin/messages">Messaggi</a></li> {{-- da rivedere!!! --}}
                            <li><a href="http://127.0.0.1:8000/admin/reviews">Recensioni</a></li>
                            <li><a href="#">Sponsorships</a></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
