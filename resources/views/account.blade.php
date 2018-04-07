@extends('layouts.structure')

@section('content')
    
    <div class="container">
        <div class="row">
            <h4>Ваш Email: {{ $user->email }}</h4>
            <div class="w-100"></div>
            <h4>Ваше имя: {{ $user->name }}</h4>
            <div class="w-100"></div>
            <h4>Дата создания аккаунта: {{ $user->created_at }}</h4>
            <div class="w-100"></div>
            <a href="{{ route('logout') }}">Выйти</a>
        </div>        
    </div>

@endsection
