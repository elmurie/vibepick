@extends('layouts.app')

@section('content')
    <h2>Siamo nel pagamento</h2>
    
    @foreach ($sponsorships as $sponsorship)
        <h4>{{$sponsorship->name}}</h4>
    @endforeach


@endsection