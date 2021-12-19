@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card profile d-flex flex-column flex-lg-row justify-content-center">
                    <div class="card-left bg-light-blue text-center">
                        <div class="container_personal_pic">
                            <img class="personal_pic" src="{{$user['profile_pic'] != null ? asset('storage/' . $user->profile_pic) : asset('storage/profile-placeholder.png')}}" alt="Profile pic di {{$user['profile_pic'] ? $user['firstname'] : 'default'}}">
                        </div>
                        <div class="sponsorship bg-light-blue {{$user->is_sponsored == false ? 'd-none' : 'd-block'}}">
                            <div class="sponsorship__title">
                                <h3>Hai una sponsor <br> <span class="color__{{$user->is_sponsored == false ? 'd-none' : $sponsorship->id}}"> {{$user->is_sponsored == false ? 'd-none' : $sponsorship->name}} </span> attiva</h3>
                                <div class="container_img">
                                    <img src="{{$user->is_sponsored == false ? 'd-none' : asset('../storage/img/sponsor_logo_'.$sponsorship->id.'.png')}}" alt=""> 
                                </div>
                            </div>
                            <p><strong>Dal:</strong> {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->start_time}}</p>
                            <p><strong>Al:</strong> {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->end_time}}</p>
                            <p><strong>Acquistata il:</strong> {{$user->is_sponsored == false ? 'd-none' : $sponsorship->pivot->sale_time}}</p>

                        </div>
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
                        <a class="align-self-end" href="{{route('admin.users.edit')}}"><button class="btn">Modifica</button></a>
                    </div>
                </div>
            </div>
            {{-- immagine con controllo se è presente, altrimenti mostra un placeholder --}}
        </div>
    </div>
@endsection