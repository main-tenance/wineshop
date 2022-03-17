<div class="enter-w login__form">
    <p class="caption">{{__('app.login')}}</p>

    <form class="center_align">
        @csrf
        <div class="inp-outer">
            <div>{{__('app.username')}}</div>
            <input type="text" name="login" value="">
        </div>
        <div class="inp-outer">
            <div>{{__('app.password')}}</div>
            <input type="password" name="password" autofocus>
        </div>

        <div class="form__row form__row__error"></div>

        <button type="submit" class="btn btn--fill">{{__('app.login')}}</button>
    </form>

    <a class="reg registration_fb" data-url="{{\App\Http\Routes\Web\WebRoutesProvider::userCreatePopup()}}">{{__('app.register')}}</a>

    <img src="/images/img/exit.svg" class="exit">
</div>
