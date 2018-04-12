@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">

            @if($check)
                <h1>Пользователей не найденo</h1>
            @endif

            @foreach($users as $user)
                <h1><a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }}</a></h1>
                <div class="w-100"></div>
            @endforeach
        </div>    
    </div>
@endsection
