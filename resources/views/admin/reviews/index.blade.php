{{-- stile inline momentaneo!!! --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card reviews d-flex flex-column justify-content-center">
                    <div class="card-header padding-card bg-dark-blue b-radius-header text-center">
                        <h2>Recensioni di {{$user['firstname']}}</h2>
                    </div>
                    <div class="card-body bg-light-blue b-radius-body d-flex flex-column justify-center">
                        @foreach ($reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="header-top text-center">
                                    <h4>{{$review['title']}}</h4>
                                </div>
                                <div class="header-bottom d-flex justify-content-between">
                                    <div class="bottom-lx">
                                        <h4>Autore: {{$review['author']}}</h4>
                                        <h4>Voto: {{$review['vote']}}</h4>
                                    </div>
                                    <div class="bottom-rx">
                                        <h4>{{$review['created_at']}}</h4>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="review-body">
                                <p>{{$review['content']}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection