@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profilo di {{$user->firstname}} {{$user->lastname}}</h1>
    <img style="height: 200px" src="{{$user['profile_pic'] != null ? asset('storage/' . $user->profile_pic) : 'https://via.placeholder.com/200'}}" alt="Profile pic di {{$user['profile_pic'] ? $user['firstname'] : 'default'}}">
</div>

    <form method="POST" action="{{ route('admin.users.update', $user['id']) }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        {{-- <div class="form-group row">
            <label for="first" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user['firstname']}} " required autocomplete="firstname" autofocus>

                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> --}}

        {{-- <div class="form-group row">
            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ?? $user['lastname']}}" required autocomplete="lastname" autofocus>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> --}}

        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

            <div class="col-md-6">
                <input id="address" 
                        type="text" 
                        class="form-control @error('address') is-invalid @enderror" 
                        name="address"
                        placeholder="Inserisci il tuo indirizzo..."
                        oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo indirizzo')"  
                        value="{{ old('address') ?? $user['address'] }}" required autocomplete="address" autofocus>

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
                <input id="phone_number" 
                        type="tel" 
                        minlength="10" 
                        maxlength="16" 
                        class="form-control @error('phone_number') is-invalid @enderror" 
                        name="phone_number" 
                        value="{{ old('phone_number')  ?? $user['phone_number']}}"
                        placeholder="Inserisci il tuo numero di telefono..."
                        oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo numero di telefono')" 
                        autocomplete="phone_number" autofocus>

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
                <input id="email" 
                        type="email" 
                        pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" 
                        title="L'email non è ben formattata" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') ?? $user['email']}}"
                        placeholder="Inserisci la tua email..."
                        oninvalid="setCustomValidity('Ops... ricordati di inserire la tua email')"  
                        required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- Sistemare stile : allineamento--}}
        <div class="form-group row">
            <div class="col-md-4 col-form-label text-md-right row justify-content-end px-0">
                <div class="col-md-6 px-0">
                    {{__('Seleziona gli strumenti con cui sei specializzato')}}
                </div>
            </div>
            <div class="col-md-6 px-4">
                @foreach ($instruments as $instrument)
                <div class="custom-control custom-checkbox px-5">
                    @if ($errors->any())
                    <input {{in_array($instrument->id, old('instruments', []))? "checked" : null}} name="instruments[]" value="{{$instrument->id}}" name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" id="instrument-{{$instrument->id}}" onclick="deRequireCb('checkValidation')" {{"checked"? " " : "required"}}>
                    @else
                    <input {{$user['instruments']->contains($instrument->id) ? "checked" : null}} name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" id="instrument-{{$instrument->id}}" onclick="deRequireCb('checkValidation')" {{"checked"? " " : "required"}}>    
                    @endif
                    <label class="custom-control-label" for="instrument-{{$instrument->id}}">{{$instrument->name}}</label>     
                </div>
                @endforeach
            </div>
        </div>
        @error('instruments')
            <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror

        

        <div class="form-group row">
            <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Generi Musicali') }}</label>

            <div class="col-md-6">
                <input id="genre" 
                        type="genre" 
                        class="form-control @error('genre') is-invalid @enderror" 
                        name="genre" 
                        value="{{ old('genre') ?? $user['genre'] }}"
                        placeholder="Inserisci un genere..."
                        oninvalid="setCustomValidity('Ops... ricordati di inserire un genere')"   
                        autocomplete="genre">

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
                <input id="services" 
                        type="services" 
                        class="form-control @error('services') is-invalid @enderror" 
                        name="services" 
                        value="{{ old('services') ?? $user['services']}}"
                        placeholder="Inserisci un servizio..."
                        oninvalid="setCustomValidity('Ops... ricordati di inserire un servizio')"   
                        autocomplete="services">

                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- <div class="form-group row">
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
        </div> --}}
        <div class="form-group row">
            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Carica la tua foto profilo') }}</label>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="custom-file flex-wrap">
                        <input type="file" name="image" id="image" class=" col-12 px-0 @error('image') is-invalid @enderror"> 
                        @error('image')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
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
    
    <form action="{{route("admin.users.destroy", $user['id'])}}" method="POST">
        @csrf
        @method("DELETE")
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button class="btn btn-danger" type="submit">Elimina il tuo profilo</button>
            </div>
        </div>
    </form>
    

    
@endsection