@extends('layouts.structure')

@section('content')
    
    <div class="container">
        <div class="row">
            <a href="{{ route('logout') }}">Выйти</a>
            <div class="w-100"></div>
            <h4>Ваш Email: {{ $user->email }}</h4>
            <div class="w-100"></div>
            <h4>Ваше имя: {{ $user->name }}</h4>
            <div class="w-100"></div>
            <h4>Дата создания аккаунта: {{ $user->created_at }}</h4>
            <div class="w-100"></div>
            <h3>Рифмы</h3>
            <div class="w-100"></div>
            @foreach($rhymes as $rhyme)
                <h1><a href="{{ route('rhyme', ['id' => $rhyme->id]) }}">{{ $rhyme->title }}</a></h1>
                <div class="w-100"></div>
            @endforeach
       </div>        
    </div>

@endsection
