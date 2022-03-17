@extends('layouts.my-app')

@section('title', 'Main')

@section('content')

    <div class="cabinet__title">{{__('app.authorization')}}</div>

    <div class="form cabinet_form">
        <form name="form_auth" method="POST" action="{{\App\Http\Routes\Web\WebRoutesProvider::loginStore()}}">
            @csrf
            <div class="cabinet_form__fields">
                <div class="form__row required">
                    <div class="form__label">
                        <label>{{__('app.username')}}<span><i class="fas fa-asterisk"></i></span></label>
                    </div>
                    <div class="form__widget">
                        <input type="text" name="login" value="">
                    </div>
                </div>
                <div class="form__row required">
                    <div class="form__label">
                        <label>{{__('app.password')}}</label>
                    </div>
                    <div class="form__widget">
                        <input type="password" name="password" autofocus>
                    </div>
                </div>
                <div class="form__row required">
                    <div class="form__label">
                        <label>Запомнить меня</label>
                    </div>
                    <div class="form__widget">
                        <input type="checkbox" name="remember">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__label" style="height: 1.3em;">
                        <label></label>
                    </div>
                    <div class="form__widget">
                        <button class="btn btn--fill" style="width: 100%;" type="submit">Войти</button>
                    </div>
                </div>
            </div>
            <div class="form__row form__row__error">
                @foreach ($errors->all() as $message)
                    <div>{{$message}}</div>
                @endforeach
            </div>
        </form>
        <div class="auth-notice">
            Если вы впервые на сайте, заполните пожалуйста
            <a class="registration_fb" data-url="{{\App\Http\Routes\Web\WebRoutesProvider::userCreatePopup()}}">
                регистрационную форму
            </a>.
        </div>
        <div class="auth-notice">
            Забыли свой пароль? Следуйте на <a href="{{ route('password.request') }}">форму для запроса пароля</a>.
        </div>
    </div>

@endsection

