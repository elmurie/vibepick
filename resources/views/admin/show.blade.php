@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Pagina che mostra il profilo e prende i vari dati mostati a schermo dal DB --}}
                <h1>Profilo di {{$user['firstname']}} {{$user['lastname']}}</h1>
                {{-- immagine con controllo se è presente, altrimenti mostra un placeholder --}}
                <img style="height: 200px" src="{{$user['profile_pic'] != null ? asset('storage/' . $user->profile_pic) : 'https://via.placeholder.com/200'}}" alt="Profile pic di {{$user['profile_pic'] ? $user['firstname'] : 'default'}}">
                <h3>Indirizzo : {{$user['address']}}</h3>
                <h3>Telefono : {{$user['phone_number']}}</h3>
                <h3>Email : {{$user['email']}}</h3>
                <h3>Generi musicali : {{$user['genre']}}</h3>
                <h3>Servizi offerti : {{$user['services']}}</h3>
                <h3>Strumenti suonati:</h3>
                <ul>
                    @foreach ($user['instruments'] as $instrument)
                        <li>{{$instrument['name']}}</li>
                    @endforeach
                </ul>
                <a href="{{route('admin.users.edit', $user['id'])}}">Modifica Profilo</a>
            </div>
        </div>
    </div>
@endsection
