@extends('layouts.sponsor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 checkout">
            <div class="card checkout d-flex flex-column justify-content-center">
                <div class="card-header bg-dark-blue b-radius-header text-center">
                    <h1>Procedi all'acquisto</h1>
                </div>
                <div class="card-body bg-light-blue b-radius-body d-flex flex-column justify-center">
                    <div class="checkout-card">
                        <div class="checkout-header d-flex flex-column justify-content-start align-start">
                            <div class="header-top">
                                <img src="../../storage/img/sponsor_logo_{{$sponsorship->id}}.png" alt="{{$sponsorship['name']}}">
                                <h3 class="title">{{$sponsorship->name}} Sponsorship</h3>
                            </div>
                            <div class="header-bottom">
                                <h4>Prezzo: {{$sponsorship['price']}}€</h4>
                                <h4>Il tuo profilo sarà visibile in homepage per {{$sponsorship->duration * 24}} ore</h4>
                            </div>
                        </div>
                        <div class="checkout-body d-flex flex-column">
                            <div class="content">
                                <form method="post" id="payment-form" action="{{ url('/admin/checkout') }}">
                                    @csrf
                                    <section>
                            
                                        <input id="sponsor_id" name="sponsor_id" hidden value="{{$sponsorship->id}}">
                                        <div class="start-time">
                                            <label for="start_time">Inserisci la data e ora d'inizio della sponsorship:</label>
                                            <input id="start_time" name="start_time"  type="datetime-local" min="2021-12-01 00:00" required>
                                        </div>
                            
                                        <div class="bt-drop-in-wrapper">
                                            <div id="bt-dropin"></div>
                                        </div>
                                    </section>
                                    <div class="btn-wrapper">
                                        <input id="nonce" name="payment_method_nonce" value="fake-valid-visa-nonce" type="hidden" />
                                        <button class="btn button" type="submit"><span>Test Transaction</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection