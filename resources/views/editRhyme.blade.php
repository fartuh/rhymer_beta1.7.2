@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error  }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
            <form method="POST" action="{{ URL::to(route('editPost')) }}">
                {{ csrf_field() }}
                <input name="id" type="hidden" value="{{ $id }}">
                <label>Заголовок</label>
                <div class="w-100"></div>
                <input class="form-control" type="text" name="title" value="{{ $rhyme->title }}">
                <div class="w-100"></div>
                <label>Текст</label>
                <div class="w-100"></div>
                <textarea class="form-control" name="text" cols="80" rows="5">{{ $rhyme->text }}</textarea>
                <div class="w-100"></div>
                <label></label>
                <div class="w-100"></div>
                <input class="btn btn-primary" type="submit" value="Обновить">
                <div class="w-100"></div>
                <label></label>
 </form>
        </div>    
    </div>
@endsection
