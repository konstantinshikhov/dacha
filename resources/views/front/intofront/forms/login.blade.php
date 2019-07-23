<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Умная дача</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/common.css')}}">
</head>

<body class="">
<div class="login-wrap">
    <div class="login text-center">
        <a href="{{ url('/') }}"><img class="sc-login-logo" src="images/header-logo-main.png" alt=""></a>
        <div class="login-title">ВХОД В ЛИЧНЫЙ КАБИНЕТ</div>
        @if(isset($success))
        <h3>{{ $success }}</h3>
        @endif

        @if(isset($error))
            <h3>{{ $error }}</h3>
        @endif
        <form method="post" action="{{ url('/log-in') }}">
            {{ csrf_field() }}
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <input type="email" name="email" placeholder="Email">
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit" value="ВОЙТИ" class="button" />
        </form>
        <!---->
        <div class="login-bottom">
            <div class="l-bottom-forgot-password"><a href="#" class="">ЗАБЫЛИ ПАРОЛЬ?</a></div>
            <div class="l-bottom-to-register"><a href="{{ url('/register') }}" class="">НЕТ АКАУНТА?  ЗАРЕГИСТРИРОВАТЬСЯ</a></div>
        </div>
        <div class="text-center">
            <ul class="soc">
                <li class="fb"><a href="#"></a></li>
                <li class="tw"><a href="#"></a></li>
                <li class="inst"><a href="#"></a></li>
                <li class="yt"><a href="#"></a></li>


            </ul>
        </div>
    </div>
</div>
</body>

</html>