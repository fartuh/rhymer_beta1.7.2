@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">

            @if($check)
                <h1>Записей не найденo</h1>
            @endif

            @foreach($rhymes as $rhyme)
                <h1><a href="{{ route('rhyme', ['id' => $rhyme->id]) }}">{{ $rhyme->title }}</a></h1>
                <div class="w-100"></div>
                @foreach($rhyme->categories as $category)
                    <a class="m-1" href="{{ route('tag', ['tag' => $category->name]) }}"><h5 class="btn btn-primary">{{ $category->name }}</h5></a> 
                @endforeach               
                <div class="w-100"></div>
                <h3>Автор: {{ $rhyme->author->name }}</h3>
                <div class="w-100"></div>
            @endforeach
        </div>    
    </div>
@endsection
