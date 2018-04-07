@extends('layouts.structure')

@section('content')
    
    <div class="container">
        <div class="row">
            <h4>имя: {{ $user->name }}</h4>
            <div class="w-100"></div>
            <h4>Дата создания аккаунта: {{ $user->created_at }}</h4>
        </div>        
    </div>

@endsection
