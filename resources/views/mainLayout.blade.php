<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link id="appbundle" rel="stylesheet" media="screen, print" href="./public/css/app.bundle.css">
  <link id="myskin" rel="stylesheet" media="screen, print" href="./public/css/skins/skin-master.css">
  <link rel="stylesheet" media="screen, print" href="./public/css/fa-solid.css">
  <link rel="stylesheet" media="screen, print" href="./public/css/fa-brands.css">
  <link rel="stylesheet" media="screen, print" href="./public/css/fa-regular.css">
  <link rel="stylesheet" media="screen, print" href="./public/css/vendors.bundle.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="users"><img alt="logo" class="d-inline-block align-top mr-2" src="./public/img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/users">Главная <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/login">Войти</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Выйти</a>
        </li>
      </ul>
    </div>
  </nav>


  {{--main--}}
  @yield('main')

  {{--footer--}}
  @yield('footer')

  {{--js--}}
  @yield('js')

</body>

</html>