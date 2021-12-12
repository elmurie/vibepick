

@extends('layouts.app')

{{-- Nei tag input sono stati inseriti due attributi oninvalid e oninput per gestire la Client-Side validation dei dati con messaggi personalizzate e ch
    si resettano al nuovo inserimento dei dati  --}}

@section('content')

    {{-- All'interno di questo tag php abbiamo richiamato il model instrument per poter generare dinamicamnte la lista di checkbox relativa agli strumenti --}}
    @php 
        use App\Instrument;

        $instruments = Instrument::all();
    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card register">
                    <div class="card-header padding-card bg-dark-blue b-radius-header text-center">
                        <h2>{{ __('Registrazione') }}</h2>
                    </div>

                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row align-items-center">
                                <label for="first" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                                <div class="col-md-6">
                                    <input id="firstname" 
                                            type="text" 
                                            class="form-control @error('firstname') is-invalid @enderror" 
                                            name="firstname" 
                                            value="{{ old('firstname') }}"
                                            placeholder="Inserisci il tuo nome..."
                                            oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo nome')"
                                            oninput="setCustomValidity('')" 
                                            required autocomplete="firstname" autofocus>
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" 
                                            type="text" 
                                            class="form-control @error('lastname') is-invalid @enderror" 
                                            name="lastname" value="{{ old('lastname') }}"
                                            placeholder="Inserisci il tuo cognome..."
                                            oninvalid="setCustomValidity('Ops... ricordati di inserire il cognome')"
                                            oninput="setCustomValidity('')"  
                                            required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="address" 
                                            type="text" 
                                            class="form-control @error('address') is-invalid @enderror" 
                                            name="address" 
                                            value="{{ old('address') }}"
                                            placeholder="Inserisci il tuo indirizzo..."
                                            oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo indirizzo')"
                                            oninput="setCustomValidity('')"  
                                            required autocomplete="address" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Mail') }}</label>
                    
                                <div class="col-md-6">
                                    <input id="email" 
                                            type="email" 
                                            {{-- RegEx per la validazione Client-Side della mail --}}
                                            pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            name="email" 
                                            value="{{ old('email')}}"
                                            placeholder="Inserisci la tua email..."
                                            oninvalid="setCustomValidity('Ops... ricordati di inserire la tua email')"
                                            oninput="setCustomValidity('')" 
                                            required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right">{{__('Strumenti')}}</div>
                                <div class="col-md-6">
                                    @foreach ($instruments as $instrument)
                                    <div class="custom-control custom-checkbox">
                                        @if ($errors->any())
                                            <input {{in_array($instrument->id, old('instruments', []))? "checked" : ""}} 
                                                    name="instruments[]" 
                                                    value="{{$instrument->id}}" 
                                                    type="checkbox" 
                                                    class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" 
                                                    id="instrument-{{$instrument->id}}" 
                                                    {{-- Richiamo della funzione per validare le checkbox al click --}}
                                                    onclick="deRequireCb('checkValidation')" required>
                                        @else
                                            <input name="instruments[]" 
                                                    value="{{$instrument->id}}" 
                                                    type="checkbox" 
                                                    class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" 
                                                    id="instrument-{{$instrument->id}}" 
                                                    {{-- Richiamo della funzione per validare le checkbox al click --}}
                                                    onclick="deRequireCb('checkValidation')" required>    
                                        @endif
                                        <label class="custom-control-label" for="instrument-{{$instrument->id}}">{{$instrument->name}}</label>     
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>
                            @error('instruments')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror

                            <div class="form-group row align-items-center">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" 
                                            type="password" 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            name="password"
                                            placeholder="Inserisci la tua password..."
                                            oninvalid="setCustomValidity('Ops... ricordati di inserire la tua password')"
                                            oninput="setCustomValidity('')"  
                                            required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    oninput="setCustomValidity('')"
                                    placeholder="Inserisci di nuovo la tua password..." 
                                    required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="mandatory row align-items-center py-2 mb-2">
                                <div class="col-md-4 col-form-label text-md-right"></div>
                                <small class="col-md-6">*campo obbligatorio</small>
                            </div>

                            <div class="form-group row align-items-center mt-5 mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
