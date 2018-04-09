@extends('layouts.structure')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol class="">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error  }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="w-100"></div>
            @endif

            <form method="POST" action="{{ URL::to(route('newPost')) }}">
                {{ csrf_field() }}
                <label>Заголовок</label>
                <div class="w-100"></div>
                <input class="form-control" type="text" name="title">
                <div class="w-100"></div>
                <label>Текст</label>
                <div class="w-100"></div>
                <textarea class="form-control" name="text" cols="80" rows="5"></textarea>
                <div class="w-100"></div>
                <label>Метки</label>
                <div class="w-100"></div>
                <input class="form-control" placeholder="вводите через пробел" type="text" name="categories">
                <div class="w-100"></div>
                <label></label>
                <div class="w-100"></div>
                <input class="btn btn-primary" type="submit" value="Создать">
                <div class="w-100"></div>
                <label></label>
            </form>
        </div>    
    </div>
@endsection
