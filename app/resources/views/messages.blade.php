@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header titulo">Messages</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    @foreach($messages as $msg)
                    <form method="get" id="formChat{{$msg['id']}}" action="{{ route('chat') }}">
                    
                    <input type="hidden" name="id" value="{{ $msg['id'] }}"/>
                    </form>
                   
                    <a class="nav-link" href="#" onClick="document.getElementById('formChat{{ $msg['id'] }}').submit();">
                    <div class="card-header card-post">
                    <div class="row col">
                    <img src="{{ $msg['foto'] }}">
                    <button class="titulo" style="color: inherit; background-color: inherit; border: none; outline-style: none;"> {{ $msg['name'] }}</button>
                    </div>
                    </div>
                    </a>
    
                    
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
