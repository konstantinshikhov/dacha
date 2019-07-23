
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
    <div class="sc-registration-form text-center">
        <a href="{{ url('/') }}"><img class="sc-login-logo" src="images/header-logo-main.png" alt=""></a>
        <div class="login-title">СОЗДАНИЕ НОВОГО ПОЛЬЗОВАТЕЛЯ</div>

        <form method="POST" action="{{ url('/registerup') }}">
            {!! csrf_field() !!}
            <input type="text" name="first_name" placeholder="Имя">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <input type="text" name="last_name" placeholder="Фамилия">
            <input type="email" name="email" placeholder="Email">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <input type="password" name="password" placeholder="Пароль (мин. 8 символов)">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <input type="password" name="password_confirmation" placeholder="Повторите пароль">

            @if ($errors->has('agreement'))
                <span class="help-block">
                    <strong>{{ $errors->first('agreement') }}</strong>
                </span>
            @endif
            <div class="check-agreement d-flex align-items-center">
                <input type="checkbox" id="agreement" name="agreement" >
                <div>
                    <label for="agreement" class="mb-0">Ознакомлен с пользовательскими</label>
                    <a href="{{ URL::to('/agreement') }}" class="" target="_blank">соглашениями</a>
                </div>

            </div>
            <input type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ" class="button" />
        </form>
        <!---->
        <div class="text-center">
            <ul class="soc">
                <li class="fb"><a href="#"></a></li>
                <li class="tw"><a href="#"></a></li>
                <li class="inst"><a href="#"></a></li>
                <li class="yt"><a href="#"></a></li>
            </ul>
        </div>
    </div>
    <!---->
</div>
</body>

</html>