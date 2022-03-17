<!DOCTYPE html>
<html lang="{{$locale}}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/myapp.css') }}">
</head>
<body>

<div class="compensate-for-scrollbar global_wrapper" data-locale="{{$locale}}" data-age="{{$age}}" data-minage="{{$minAge}}">
    <header>
        <div class="all">
            <nav class="topmenu">
                @include('layouts.menu')
            </nav>
            <div class="head">
                <a href="{{\App\Http\Routes\Web\WebRoutesProvider::mainIndex()}}" class="logo">{{__('app.name')}}</a>
                <div id="big_search_wrapper" class="search">
                    <form>
                        <input id="title-search-input" class="search_input" type="text" name="q"
                               placeholder="Поиск по сайту" value="" autocomplete="off">
                        <input type="submit" value="">
                    </form>
                    <div id="search_result" class="title-search-result" style="display: none;"></div>
                </div>
                <div class="right">
                    <a href="tel:+{{__('app.phone')}}" class="phone">+{{__('app.phone_formatted')}}</a>
                    <div class="btns">
                        @auth
                            <div class="if-authorized">
                                <div>{{json_decode(Auth::user(), true)['name']}}</div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <a class="logout">{{__('app.logout')}}</a>
                                </form>
                            </div>
                        @endauth
                        @guest
                            <div class="enter">
                                <span>{{__('app.login')}}</span>
                            </div>
                        @endguest
                        <a href="/cart" class="cart"></a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="mainmenu">
            <div class="all">
                <a href="" class="link-nav"></a>
                <ul id="categories">
                    @include('layouts.categories', ['svg' => true])
                </ul>
            </div>
        </nav>
    </header>

    <div class=" content">
        <div class="wrapper">
            <div>
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <div class="footer__contacts">
            <div class="wrapper">
                <div class="our-store">
                    <div><b>{{__('app.store.caption')}}:</b></div>
                    <div class="address">{{__('app.store.address')}}</div>
                    <div class="work_time">{{__('app.store.hours')}}</div>
                </div>
                <div class="subscription">
                    <div><b>{{__('app.subscribe')}}: </b></div>
                    <div class="subscribe">
                        <input type="email" name="email" placeholder="Email" maxlength="254">
                        <button type="submit">ОК</button>
                    </div>
                </div>
                <div class="social">
                    <div>
                        <a class="email" href="mailto:{{__('app.email')}}">
                            <b>{{__('app.email')}}</b>
                        </a>
                    </div>
                    <div>
                        <div style="text-align: left;">{{__('app.for_orders')}}:</div>
                        <a class="email" href="mailto:{{__('app.email')}}">
                            <b>{{__('app.email')}}</b>
                        </a>
                    </div>
                </div>
                <div class="phone-contact social">
                    <a class="phone" href="tel:+{{__('app.phone')}}">+{{__('app.phone_formatted')}}</a>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="https://www.instagram.com/romashka_m.ru/" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/romashka_m.ru" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__menus">
            <div class="wrapper">
                <div class="footer__menu">
                    <div class="menu__title">{{__('app.company')}}</div>
                    <ul>
                        @include('layouts.menu')
                    </ul>
                </div>
                <div class="footer__menu footer__menu--three">
                    <div class="menu__title">{{__('app.products')}}</div>
                    <ul>
                        @include('layouts.categories', ['svg' => false])
                    </ul>
                </div>
                <div class="footer__logo">
                    <div class="company__name">{{__('app.name')}}</div>
                    <a class="company__logo" href="/">
                        <img src="/images/logotype.png" alt="{{__('app.name')}}" width="85" height="109">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer__disclaimer">
            <div class="wrapper">
                <p>{{__('app.attention')}}</p>
                <a href="">{{__('app.more')}}</a>
            </div>
        </div>
    </footer>

</div> <!--  закрывает <div class="compensate-for-scrollbar global_wrapper"> -->

<script src="{{ mix('js/libs.js') }}"></script>
<script src="{{ mix('js/myapp.js') }}"></script>

<div class="popup popup--registration" id="registration">
    <div class="popup-inner"></div>
</div>

<div id="notify" class="popup">
    <div class="popup-inner"></div>
</div>

</body>
</html>
