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
                            <li>Profilo personale</li>
                            <li>Messaggi</li>
                            <li>Recensioni</li>
                            <li>Sponsorships</li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
