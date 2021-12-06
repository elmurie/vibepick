

@extends('layouts.app')

@section('content')
@php 
use App\Instrument;
use App\User;

$instruments = Instrument::all();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

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
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

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
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

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
                                <input id="phone_number"  type="tel" minlength="10" maxlength="16" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

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
                                <input id="email" type="email" 
                                        pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" 
                                        title="L'email non è ben formattata" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email')}}" required autocomplete="email">
                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right justify-content-end px-0">{{__('Seleziona gli strumenti con cui sei specializzato')}}</div>
                            <div class="col-md-6 px-4">
                                @foreach ($instruments as $instrument)
                                <div class="custom-control custom-checkbox px-5">
                                    @if ($errors->any())
                                        <input {{in_array($instrument->id, old('instruments', []))? "checked" : ""}} name="instruments[]" value="{{$instrument->id}}" name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" id="instrument-{{$instrument->id}}" onclick="deRequireCb('checkValidation')" required>
                                    @else
                                        <input name="instruments[]" value="{{$instrument->id}}" type="checkbox" class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" id="instrument-{{$instrument->id}}" onclick="deRequireCb('checkValidation')" required>    
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
