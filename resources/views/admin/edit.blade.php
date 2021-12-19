@extends('layouts.app')

{{-- Nei tag input sono stati inseriti due attributi oninvalid e oninput per gestire la Client-Side validation dei dati con messaggi personalizzate e ch
    si resettano al nuovo inserimento dei dati  --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card edit d-flex flex-column flex-lg-row justify-content-center">
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
                        <h1>{{$user->firstname}} {{$user->lastname}}</h1>
                        <h4>Modifica profilo</h4>
                        <div class="info">
                            <form method="POST" action="{{ route('admin.users.update')}}" enctype="multipart/form-data">
                                @csrf 
                                @method('PUT')
                    
                    
                                <div class="form-group row align-items-center">
                                    <label for="address" class="col-md-4 text-md-right">{{ __('Indirizzo') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="address" 
                                                type="text" 
                                                pattern="^(Via|via|Viale|viale|Corso|corso|Piazza|piazza)[ a-zA-z ]*[,][ ][0-9]*$"
                                                class="form-control @error('address') is-invalid @enderror" 
                                                name="address"
                                                placeholder="Inserisci il tuo indirizzo..."
                                                oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo indirizzo')"
                                                oninput="setCustomValidity('')"   
                                                value="{{ old('address') ?? $user['address'] }}" required autocomplete="address" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mandatory row align-items-center py-2">
                                    <div class="col-md-4 col-form-label text-md-right"></div>
                                    <small class="col-md-8">*campo obbligatorio</small>
                                </div>
                    
                                <div class="form-group row align-items-center">
                                    <label for="phone_number" class="col-md-4 text-md-right">{{ __('Numero Telefonico') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="phone_number" 
                                                type="tel"
                                                {{-- pattern="^(00|\+)39[ ][0-9]{10,10}"  --}}
                                                minlength="10" 
                                                maxlength="16" 
                                                class="form-control @error('phone_number') is-invalid @enderror" 
                                                name="phone_number" 
                                                value="{{ old('phone_number')  ?? $user['phone_number']}}"
                                                placeholder="Inserisci il tuo numero di telefono..."
                                                oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo numero di telefono +39 -numero- ')"
                                                oninput="setCustomValidity('')"  
                                                autocomplete="phone_number" autofocus>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-group row align-items-center">
                                    <label for="email" class="col-md-4 text-md-right">{{ __('Indirizzo Mail') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="email" 
                                                type="email" 
                                                {{-- RegEx per la validazione Client-Side della mail --}}
                                                pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                name="email" 
                                                value="{{ old('email') ?? $user['email']}}"
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
                                <div class="mandatory row align-items-center py-2">
                                    <div class="col-md-4 col-form-label text-md-right"></div>
                                    <small class="col-md-8">*campo obbligatorio</small>
                                </div>
                    
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 text-md-right">{{__('Strumenti')}}</label>
                                    
                                    <div class="col-md-8">
                                        @foreach ($instruments as $instrument)
                                        <div class="custom-control custom-checkbox">
                                            @if ($errors->any())
                                            <input {{in_array($instrument->id, old('instruments', []))? "checked" : null}} 
                                                name="instruments[]" 
                                                value="{{$instrument->id}}" 
                                                type="checkbox" 
                                                class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" 
                                                id="instrument-{{$instrument->id}}" 
                                                {{-- Richiamo della funzione per validare le checkbox al click, il ternario serve a non avere l'errore nel caso di mancata modifica --}}
                                                onclick="deRequireCb('checkValidation')" {{ "checked" ? "" : "required" }}>
                                            @else
                                            <input {{$user['instruments']->contains($instrument->id) ? "checked" : null}} 
                                                name="instruments[]" 
                                                value="{{$instrument->id}}" 
                                                type="checkbox" 
                                                class="custom-control-input @error('instrument_id') is-invalid @enderror checkValidation" 
                                                id="instrument-{{$instrument->id}}" 
                                                {{-- Richiamo della funzione per validare le checkbox al click, il ternario serve a non avere l'errore nel caso di mancata modifica --}}
                                                onclick="deRequireCb('checkValidation')" {{ "checked" ? "" : "required" }}>    
                                            @endif
                                            <label class="custom-control-label" for="instrument-{{$instrument->id}}">{{$instrument->name}}</label>     
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('instruments')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mandatory row align-items-center py-2">
                                    <div class="col-md-4 col-form-label text-md-right"></div>
                                    <small class="col-md-8">*campo obbligatorio</small>
                                </div>
                    
                                
                                <div class="form-group row align-items-center">
                                    <label for="genre" class="col-md-4 text-md-right">{{ __('Generi Musicali') }}</label>
                                    <div class="col-md-8">
                                        <input id="genre" 
                                                type="text" 
                                                class="form-control @error('genre') is-invalid @enderror" 
                                                name="genre" 
                                                value="{{ old('genre') ?? $user['genre'] }}"
                                                placeholder="Inserisci un genere..."
                                                oninvalid="setCustomValidity('Ops... ricordati di inserire un genere')"
                                                oninput="setCustomValidity('')"    
                                                autocomplete="genre">
                    
                                            @error('genre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-group row">
                                    <label for="services" class="col-md-4 text-md-right">{{ __('Servizi offerti') }}</label>
                                    
                                    <div class="col-md-8">
                                        <textarea rows="4" cols="50" id="services" 
                                                class="form-control @error('services') is-invalid @enderror" 
                                                name="services" 
                                                placeholder="Inserisci un servizio..."
                                                oninvalid="setCustomValidity('Ops... ricordati di inserire un servizio')"
                                                oninput="setCustomValidity('')"    
                                                autocomplete="services">{{ old('services') ?? $user['services']}}
                                        </textarea>
                                        @error('services')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-group row">
                                    <label for="curriculum" class="col-md-4 text-md-right">{{ __('CV') }}</label>
                                    
                                    <div class="col-md-8">
                                        <textarea rows="20" cols="50" id="curriculum" 
                                                class="form-control @error('curriculum') is-invalid @enderror" 
                                                name="curriculum" 
                                                placeholder="Inserisci il tuo CV..."
                                                oninvalid="setCustomValidity('Ops... ricordati di inserire il tuo CV')"
                                                oninput="setCustomValidity('')"    
                                                autocomplete="curriculum">{{ old('curriculum') ?? $user['curriculum']}}
                                        </textarea>
                                        @error('curriculum')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="form-group row align-items-center">
                                    <label for="image" class="col-md-4 text-md-right">{{ __('Carica una foto profilo') }}</label>
                                    <div class="col-md-8">
                                        <div class="input-group mb-3">
                                            <div class="custom-file flex-wrap">
                                                <input type="file" name="image" id="image" class="col-12 px-0 @error('image') is-invalid @enderror"> 
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
                                    <div class="save_parent col-md-12">
                                        <button type="submit" class="btn">
                                            {{ __('Salva Modifiche') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                    
                            {{-- bottone eliminazione --}}
                            <div class="form-group row mb-0">
                                <div class="delete_parent col-md-12">
                                    <button id="modalBtn" type="submit" class="btn btn-danger " data-id="{{$user['id']}}" data-toggle="modal" data-target="#deleteModal">Elimina utente</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modale di cancellazione --}}
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content d-flex flex-column">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel">Conferma cancellazione</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route("admin.users.destroy")}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" id="delete-id" name="id">
                        <div class="modal-body">
                            Il tuo profilo verrà cancellato.<br>
                            Vuoi procedere comunque?
                        </div>
                        <div class="modal-footer d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Sì</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
@endsection