@extends('layouts.structure')

@section('content')
    
    <div class="container">
        <div class="row">
            @if($user->id == Auth::id())
                <a href="{{ route('logout') }}">Выйти</a>
                <div class="w-100"></div>
                <a href="{{ route('subscribeon') }}">На кого подписан</a>
                <div class="w-100"></div>
                <a href="{{ route('subscribers') }}">Подписчики</a>
                <div class="w-100"></div>
            @endif

            @if($user->id != Auth::id())
                @if($subscribe == true)
                    <a href="{{ route('unsubscribe', ['id' => $user->id]) }}">Отписаться</a>
                    <div class="w-100"></div>
                @else
                    <a href="{{ route('subscribe', ['id' => $user->id]) }}">Подписаться</a>
                    <div class="w-100"></div>
                @endif
            @endif
            <h4>имя: {{ $user->name }}</h4>
            <div class="w-100"></div>
            <h4>Дата создания аккаунта: {{ $user->created_at }}</h4>
            <div class="w-100"></div>
            <h3>Рифмы:</h3>
            <div class="w-100"></div>
            @foreach($rhymes as $rhyme)
                <h4><a href="{{ route('rhyme', ['id' => $rhyme->id]) }}">{{ $rhyme->title }}</a></h4>
                <div class="w-100"></div>
            @endforeach
       </div>        
    </div>

@endsection
