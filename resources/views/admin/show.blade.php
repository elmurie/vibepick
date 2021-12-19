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
                        <div class="sponsorhip {{$user->is_sponsored == false ? 'd-none' : 'd-block'}}">
                            <h3>Hai una sponsorizzazione attiva <img src="{{$user->is_sponsored == false ? 'd-none' : asset('../storage/img/sponsor_logo_'.$sponsorship->id.'.png')}}" alt=""> </h3>
                            <h3>Dal: {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->start_time}}</h3>
                            <h3>Al: {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->end_time}}</h3>
                            <h3>Acquista il {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->sale_time}}</h3>

                        </div>
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
                        <a class="align-self-end" href="{{route('admin.users.edit')}}"><button class="btn">Modifica</button></a>
                    </div>
                </div>
            </div>
            {{-- immagine con controllo se è presente, altrimenti mostra un placeholder --}}
        </div>
    </div>
@endsection