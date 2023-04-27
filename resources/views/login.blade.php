@extends('layout')


@section('customLayout')
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- Remove Tap Highlight on Windows Phone IE -->
<meta name="msapplication-tap-highlight" content="no">
<!-- base css -->
<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="./public/css/vendors.bundle.css">
<link id="appbundle" rel="stylesheet" media="screen, print" href="./public/css/app.bundle.css">
<link id="mytheme" rel="stylesheet" media="screen, print" href="#">
<link id="myskin" rel="stylesheet" media="screen, print" href="./public/css/skins/skin-master.css">
<!-- Place favicon.ico in the root directory -->
<link rel="apple-touch-icon" sizes="180x180" href="./public/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./public/img/favicon/favicon-32x32.png">
<link rel="mask-icon" href="./public/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
<link rel="stylesheet" media="screen, print" href="./public/css/page-login-alt.css">
@endsection

@section('login')

<div class="blankpage-form-field">
    <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
            <img src="./public/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Учебный проект</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <div class="alert alert-success">
            Регистрация успешна
        </div>
        <form action="login_handler" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="form-label" for="username">Email</label>
                <input type="email" id="username" name="email" class="form-control" placeholder="Эл. адрес" value="">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="">
            </div>
            <button type="submit" class="btn btn-default float-right">Войти</button>
        </form>
    </div>
    <div class="blankpage-footer text-center">
        Нет аккаунта? <a href="register"><strong>Зарегистрироваться</strong>
    </div>
</div>
<video poster="./public/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
    <source src="./public/media/video/cc.webm" type="video/webm">
    <source src="./public/media/video/cc.mp4" type="video/mp4">
</video>
@endsection

@section('js')
<script src="./public/js/vendors.bundle.js"></script>
@endsection