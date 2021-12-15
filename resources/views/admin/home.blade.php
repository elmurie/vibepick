@extends('layouts.app')

@section('content')
    {{-- Questa è la Dashboard del singolo Utente Registrato --}}
    <div class="container bgRed">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- card --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    {{-- header card --}}
                    <div class="card-header padding-card bg-dark-blue b-radius-header text-center">
                        <h2>Welcome to VibePick, {{$user['firstname']}}! </h2>
                    </div>
                    {{-- body card --}}
                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center">                        
                        <ul class="d-flex flex-column gap">
                            {{-- ToDo questi devono diventare link per le varie sezioni del profilo --}}
                            <li><a href="#">Profilo personale</a></li>
                            <li><a href="{{route('admin.messages.index')}}">Messaggi</a></li>
                            <li><a href="{{route('admin.reviews.index')}}">Recensioni</a></li>
                            <li><a href="{{route('admin.sponsorship')}}">Sponsorships</a></li>
                        </ul>                       
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
