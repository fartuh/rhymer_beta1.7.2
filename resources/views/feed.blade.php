@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">

            @if($check)
                <h1>Записей не найденo</h1>
            @endif

            @foreach($rhymes as $rhyme)
                @foreach($rhyme as $r)
                    <h1><a href="{{ route('rhyme', ['id' => $r->id]) }}">{{ $r->title }}</a></h1>
                    <div class="w-100"></div>
                    @foreach($r->categories as $category)
                        <a class="m-1" href="{{ route('tag', ['tag' => $category->name]) }}"><h5 class="btn btn-primary">{{ $category->name }}</h5></a> 
                    @endforeach               
                    <div class="w-100"></div>
                    <h3>Автор: {{ $r->author->name }}</h3>
                    <div class="w-100"></div>
                @endforeach
            @endforeach
        </div>    
    </div>
@endsection
