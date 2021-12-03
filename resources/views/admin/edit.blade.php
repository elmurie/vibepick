@extends('layouts.app')

@section('content')
    <h1>Profilo di {{$user->firstname}} {{$user->lastname}}</h1>
    <form method="POST" action="{{ route('admin.users.update', $user['id']) }}">
        @csrf 
        @method('PUT')

        <div class="form-group row">
            <label for="first" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user['firstname']}} " required autocomplete="firstname" autofocus>

                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ?? $user['lastname']}}" required autocomplete="lastname" autofocus>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

            <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user['address'] }}" required autocomplete="address" autofocus>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Numero Telefonico') }}</label>

            <div class="col-md-6">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number')  ?? $user['phone_number']}}" required autocomplete="phone_number" autofocus>

                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user['email']}}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- Sistemare stile : allineamento--}}
        <div class="form-group row">
            <div class="col-md-4 col-form-label text-md-right row justify-content-end">
                <div class="col-md-6">
                    {{__('Seleziona gli strumenti con cui sei specializzato')}}
                </div>
            </div>
            <div class="col-md-6 col-form-label ">
                @foreach ($instruments as $instrument)
                <div class="custom-control custom-checkbox">
                    @if ($errors->any())
                    <input {{in_array($instrument->id, old('instruments', []))? "" : "checked"}} name="instruments[]" value="{{$instrument->id}}" name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input" id="instrument-{{$instrument->id}}">
                    @else
                    <input {{$instruments->contains($instrument->id) ? "" : "checked"}} name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input" id="instrument-{{$instrument->id}}">    
                    @endif
                    <label class="custom-control-label" for="instrument-{{$instrument->id}}">{{$instrument->name}}</label>     
                </div>
                @endforeach
                @error('instrument_id')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
        </div>

        

        <div class="form-group row">
            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Generi Musicali') }}</label>

            <div class="col-md-6">
                <input id="genre" type="genre" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}" required autocomplete="genre">

                @error('genre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="services" class="col-md-4 col-form-label text-md-right">{{ __('Servizi offerti') }}</label>

            <div class="col-md-6">
                <input id="services" type="services" class="form-control @error('services') is-invalid @enderror" name="services" value="{{ old('services') }}" required autocomplete="services">

                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Salva Modifiche') }}
                </button>
            </div>
        </div>
    </form>

    
@endsection