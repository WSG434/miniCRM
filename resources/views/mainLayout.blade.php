<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>miniCRM Larvel</title>
  <link id="appbundle" rel="stylesheet" media="screen, print" href="/css/app.bundle.css">
  <link id="myskin" rel="stylesheet" media="screen, print" href="/css/skins/skin-master.css">
  <link rel="stylesheet" media="screen, print" href="/css/fa-solid.css">
  <link rel="stylesheet" media="screen, print" href="/css/fa-brands.css">
  <link rel="stylesheet" media="screen, print" href="/css/fa-regular.css">
  <link rel="stylesheet" media="screen, print" href="/css/vendors.bundle.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="/"><img alt="logo" class="d-inline-block align-top mr-2" src="/img/logo.png">miniCRM</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @if(auth()->guest())
            <li class="nav-item">
              <a class="nav-link" href="/login">Войти</a>
            </li>
        @endif

        @if(auth()->check())
            <li class="nav-item">
              <a class="nav-link" href="/logout">Выйти</a>
            </li>
        @endif
      </ul>
    </div>
  </nav>

  {{--permission for edit php--}}
  @yield('permission')

  {{--main--}}
  @yield('main')

  {{--footer--}}
  @yield('footer')

  {{--js--}}
  @yield('js')

</body>

</html>
