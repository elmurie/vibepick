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
                            <li><a href="#">Recensioni</a></li>
                            <li><a href="#">Sponsorships</a></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div id="bg__toast__vibe" class="bg__toast__vibe alert">
                <div  id="toast__vibe" class="toast__vibe toast alert" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1!important">
                    <div class="toast-header">
                        <strong class="mr-auto">VibePick</strong>
                        <button type="button" class="close" data-dismiss="alert" onclick="opacityToast()">×</button>
                    </div>
                    <div class="toast-body">
                        {{$message}}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
