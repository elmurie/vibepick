@extends('layouts.statistics')

@section('content')
                <div class="container">
                    <div class="card-header padding-card bg-dark-blue b-radius-header text-center">
                        <h2>{{$user['firstname']}}, ecco le tue statistiche </h2>
                    </div>
                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center dashboard-box" style="background-color: #ffffff; padding:10px">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center dashboard-box" style="background-color: #ffffff; margin-top:-10px; padding:10px">
                        <canvas id="userChart"></canvas>
                    </div>
                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center dashboard-box" style="background-color: #ffffff; margin-top:-10px; padding:10px">
                        <canvas id="newChart"></canvas>
                    </div>
                    <div class="card-body padding-card bg-light-blue b-radius-body d-flex justify-center dashboard-box" style="background-color: #ffffff; margin-top:-10px; padding:10px">
                        <canvas id="newerChart"></canvas>
                    </div>
                </div>
@endsection
