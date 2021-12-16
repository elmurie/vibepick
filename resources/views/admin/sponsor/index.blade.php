@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card sponsors d-flex flex-column justify-content-center">
                    <div class="card-header bg-dark-blue b-radius-header text-center">
                        <h1>Mettiti in mostra!</h1>
                        <h5>Il tuo profilo apparirà temporaneamente nella nostra homepage, scegli il tuo piano preferito</h5>
                    </div>
                    <div class="card-body bg-light-blue b-radius-body d-flex flex-column justify-center">
                        @foreach ($sponsorships as $sponsorship)
                        <div class="sponsor-card">
                            <div class="sponsor-header d-flex justify-content-center align-center">
                                    <img src="../storage/img/sponsor_logo_{{$sponsorship['id']}}.png" alt="{{$sponsorship['name']}}">
                                    <h3 class="title">{{$sponsorship->name}} Sponsorship</h3>
                            </div>
                            <div class="sponsor-body d-flex flex-column">
                                <h4>Prezzo: {{$sponsorship['price']}}€</h4>
                                <h4>Durata: {{$sponsorship['duration']}} giorni</h4>
                                <a class="align-self-end" href="{{route("admin.payment", $sponsorship->id)}}"><button class="btn">Acquista</button></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection