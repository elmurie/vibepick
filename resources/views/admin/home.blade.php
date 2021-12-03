@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="{{route('admin.users.edit', $user['id'])}}">Modifica Profilo</a>
                    
                    <form action="{{route("admin.users.destroy", $user['id'])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit">Elimina il tuo profilo</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
