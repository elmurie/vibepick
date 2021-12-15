@extends('layouts.app')

@section('content')
    <h2>Siamo nel pagamento</h2>
    
    @foreach ($sponsorships as $sponsorship)

        <div class="card__sponsor" style="margin: 0.5rem; padding: 1rem; background-color: rgb(51, 75, 95)">
            <h3>{{$sponsorship->name}}</h3>
            <h5>Costo: {{$sponsorship->price}}€</h5>
            <h5>Durata {{$sponsorship->duration}} giorni</h5>
            {{-- @dd($sponsorship) --}}
            {{-- @dd($sponsorship['id']) --}}
            <a href="{{route("admin.payment", $sponsorship->id)}}"><button>Acquista</button> </a>
        </div>
    @endforeach


@endsection