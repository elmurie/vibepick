@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card profile d-flex flex-column flex-lg-row justify-content-center">
                    <div class="card-left bg-light-blue text-center">
                        <img class="personal_pic" src="{{$user['profile_pic'] != null ? asset('storage/' . $user->profile_pic) : asset('storage/profile-placeholder.png')}}" alt="Profile pic di {{$user['profile_pic'] ? $user['firstname'] : 'default'}}">
                    </div>
                    <div class="card-right d-flex flex-column bg-dark-blue">
                        <h1>{{$user['firstname']}} {{$user['lastname']}}</h1>
                        <ul class="info">
                            <li><strong>Indirizzo : </strong>{{$user['address']}}</li>
                            <li><strong>Telefono : </strong>{{$user['phone_number']}}</li>
                            <li><strong>Email : </strong>{{$user['email']}}</li>
                            <li><strong>Generi musicali : </strong>{{$user['genre']}}</li>
                            <li><strong>Servizi offerti : </strong>{{$user['services']}}</li>
                            <li class="cv"><strong>Curriculum Vitae : </strong><br>{{$user['curriculum']}}</li>
                            <li><strong>Strumenti suonati: </strong>
                                <ul class="instrument-list d-flex flex-wrap">
                                    @foreach ($user['instruments'] as $instrument)
                                        <li>{{$instrument['name']}}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <button class="btn align-self-end"><a href="{{route('admin.users.edit')}}">Modifica</a></button>
                    </div>
                </div>
            </div>
            {{-- immagine con controllo se è presente, altrimenti mostra un placeholder --}}
        </div>
    </div>
@endsection