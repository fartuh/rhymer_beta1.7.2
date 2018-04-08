@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ $rhyme->title }}</h1>
            <div class="w-100"></div>
            <h3>{{ $rhyme->text }}</h3>
            <div class="w-100"></div>
            <h4>Автор:</h4><a href="{{ route('findprofile', ['id' => $rhyme->author->id]) }}"><h4>{{ $rhyme->author->name }}</h4></a>
        </div>    
    </div>
@endsection
