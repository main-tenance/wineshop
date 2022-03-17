<div class="slider__container">
    @guest()
        <div class="fast_registration">
            <div class="fast_registration__title">{{__('main.become_client')}}</div>
            <button type="button" class="btn btn--white_border registration_fb" data-who="SELF"
                    data-required="<?= implode(',', FORM_REGISTRATION_REQUIRED_FIELDS['SELF']); ?>">{{__('app.register')}}
            </button>
            <div class="fast_registration__disclaimer">{{__('main.registration__disclaimer')}}</div>
        </div>
    @endguest
    <div class="slider">
        <div class="js-owl-main-slider owl-carousel">
            @foreach (__('main.banners') as $banner)
                @php $src = 'short/' . $banner['CODE'] . '.jpg'; @endphp
                @auth
                    @php $src = 'long/' . $banner['CODE'] . '.jpg'; @endphp
                @endauth
                <a href="{{$banner['HREF']}}">
                    <div class="slide {{$banner['CODE']}}"
                         style="background-image: url('{{config('app:http_host')}}{{BANNERS_PATH}}{{$src}}');">
                        <div class="slide__content" style="opacity: 0.8;">
                            @isset ($banner['BIG_TITLE'])
                                <div class="slide__bigtitle">{{$banner['BIG_TITLE']}}</div>
                            @endisset
                            <div class="slide__title">{{$banner['TITLE']}}</div>
                            @if ($banner['SUBTITLE'])
                                <div class="slide__subtitle">{{$banner['SUBTITLE']}}</div>
                            @endif
                            @if ($banner['NOTICE'])
                                <div class="slide__notice">
                                    <span class="asterisk"><i
                                            class="fas fa-asterisk"></i></span>{{$banner['NOTICE']}}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach

            @php $src = 'short/cashback.jpg'; @endphp
            @auth
                @php $src = 'long/cashback.jpg'; @endphp
            @endauth
            <div class="slide cashback"
                 style="background-image: url('{{config('app:http_host')}}{{BANNERS_PATH}}{{$src}}');">
                <div class="slide__content">
                    <div class="slide__bigtitle">5%</div>
                    <div class="slide__title">{{__('main.cashback.title')}}</div>
                    <div class="slide__duration">{{__('main.cashback.text')}}</div>
                    <div class="slide__notice">
                        <span class="asterisk"><i class="fas fa-asterisk"></i></span>{{__('main.cashback.notice')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


