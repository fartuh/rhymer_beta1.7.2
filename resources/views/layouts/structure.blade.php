@section('styles')
    <link href="{{ asset('css/app.css')   }}"  rel="stylesheet">
    <link href="{{ asset('css/bootstrap-mine.css')   }}"  rel="stylesheet">
@endsection

<!DOCTYPE HTML>
<html>
  <head>
  @yield('styles')
  </head>

  <body>
@section('header')
  <div class="container">
    <div class="row">
      <h1>header</h1>
    </div>
  </div>
@endsection
@yield('header')

@section('nav')
<div class="container">
<div class="row">

<nav class="col-12 navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

  <div class="row">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('rhymes')  }}">Все рифмы</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="{{ url('/login')  }}">Регистрация/Авторизация</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('account')  }}">Аккаунт</a>
      </li>
      @if(Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('new')  }}">Новая рифма</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('rhymesme')  }}">Мои рифмы</a>
        </li>

      @endif
    </ul>
  </div>
  </div>
</div>
</div>
</div>
</nav>
@endsection
@yield('nav')

@section('content')
  <div class="container">
    <div class="row">
      <h1>content</h1>
    </div>
  </div>
@endsection
@yield('content')

@section('footer')
  <div class="container">
    <div class="row">
      <h1>footer</h1>
    </div>
  </div>
@endsection
@yield('footer')
  </body>
</html>
