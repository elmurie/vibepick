@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-10">
                @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif
                <div class="card sponsors d-flex flex-column justify-content-center">
                    <div class="card-header bg-dark-blue b-radius-header text-center">
                        <h1>Mettiti in mostra!</h1>
                        <h5>Il tuo profilo apparirà temporaneamente nella nostra homepage, scegli il tuo piano preferito</h5>
                    </div>
                    <div>
                        <div class="card-body bg-light-blue b-radius-body d-sm-flex justify-content-between" style="max-height: 750px; overflow-y: scroll">
                            <div class=" d-flex flex-column  col-sm-5">
                                @foreach ($sponsorships as $sponsorship)
                                    <div class="sponsor-card" >
                                        <div class="sponsor-header d-flex justify-content-center align-center">
                                                <img class="img-sponsor" src="../storage/img/sponsor_logo_{{$sponsorship['id']}}.png" alt="{{$sponsorship['name']}}">
                                                <h3 class="title font">{{$sponsorship->name}} Sponsorship</h3>
                                        </div>
                                        <div class="sponsor-body d-flex flex-column">
                                            <h4>Prezzo: {{$sponsorship['price']}}€</h4>
                                            <h4>Durata: {{$sponsorship['duration']}} {{$sponsorship['duration'] == 1 ? 'giorno' : 'giorni'}}</h4>
                                            <a class="align-self-end" href="{{route("admin.payment", $sponsorship->id)}}"><button class="btn">Acquista</button></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class=" d-flex flex-column col-sm-7" style="overflow-y: scroll;">
                                <h2>I tuoi acquisti</h2>
                                @foreach ($prova as $sponsor)
                                    <div class="sponsor-card  p-2">
                                        <div class="sponsor-header">
                                            <div class="d-flex align-center justify-content-between">
                                                <h2 class="title">{{$sponsor->name}}</h2>
                                                <img src="../storage/img/sponsor_logo_{{$sponsor['id']}}.png" alt="{{$sponsor['name']}}">
                                            </div>
                                        </div>
                                        <div class="sponsor-body">
                                            <h3 class="py-1">Data inizio: {{$sponsor->pivot->start_time}}</h3>
                                            <h3 class="py-1">Data fine: {{$sponsor->pivot->end_time}}</h3>
                                            <h3 class="py-1">Acquistato il: {{$sponsor->pivot->created_at}}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            </div >
                        </div>   
                    </div>
                   

                        
                </div>
            </div>
        </div>
    </div>
@endsection