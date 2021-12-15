@extends('layouts.sponsor')

@section('content')
@if (session('success_message'))
<div class="alert alert-success">
    {{ session('success_message') }}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="flex-center position-ref full-height">
@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif

<div class="content">
    <h1>

        {{$sponsorship->name}}
    </h1>
    <form method="post" id="payment-form" action="{{ url('/admin/checkout') }}">
        @csrf
        <section>
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel"  value="{{$sponsorship->price}}">
                </div>
            </label>


            <input id="sponsor_id" name="sponsor_id" hidden value="{{$sponsorship->id}}">

            <label for="start_time">Inserisci la data d'inizio della sponsorship:</label>
            <input id="start_time" name="start_time"  type="datetime-local" min="2021-12-01 00:00">

            <input id="end_time" name="end_time" hidden value="2021-11-03 18:55:19">



            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" value="fake-valid-visa-nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
</div>
</div>
@endsection