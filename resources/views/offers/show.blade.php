@extends('layouts.my-app')

@section('title', 'Products')

@section('content')
{{--    @php--}}
{{--        $breadcrumbs = [--}}
{{--        [--}}
{{--            'url' => '/',--}}
{{--            'caption' => __('app.main'),--}}
{{--        ],--}}
{{--        [--}}
{{--           'url' => \App\Http\Routes\Web\WebRoutesProvider::offerShow($offer),--}}
{{--            'caption' => $offer->name,--}}
{{--        ],--}}
{{--    ];--}}
{{--    @endphp--}}

{{--    @include('layouts.breadcrumbs')--}}

    <h1>{{stripslashes($offer->wine->name)}}</h1>
    <h2>{{$offer->wine->original}}</h2>

    <div class="offer-container">
        <div class="offer-container-left">

            <div class="chars-list">
                <ul>
                    @if(!empty($offer->year))
                        <li>{{ $offer->year }}</li>
                    @endif
                    @if(!empty($offer->wine->color))
                        <li>{{ $offer->wine->color->name }}</li>
                    @endif
                    @if(!empty($offer->sugar))
                        <li>{{ $offer->sugar->name }}</li>
                    @endif
                    @if(!empty($offer->volume))
                        <li>{{ $offer->volume }}&nbsp;л</li>
                    @endif
                    @if(!empty($offer->spirt))
                        <li>{{ $offer->spirt }}%</li>
                    @endif
                </ul>
            </div>
            <div class="detail-info">
                <div class="map">
                    <p class="detail-title">{{ $offer->wine->country->name }}</p>
                    <div class="bg"></div>
                </div>
                <div class="info">
                    <p class="detail-title">Подробно</p>
                    <div class="into">
                        <div class="in">
                            <div>Страна</div>
                            <div>{{ $offer->wine->country->name }}</div>
                        </div>
                        @if(!empty($offer->wine->area))
                            <div class="in">
                                <div>Регион</div>
                                <div>{{ $offer->wine->area->name }}</div>
                            </div>
                        @endif
                        <div class="in">
                            <div>Производитель</div>
                            <div>{{ $offer->wine->creator->name }}</div>
                        </div>
                        @if(!empty($offer->vines->pluck('name')->toArray()))
                            <div class="in">
                                <div>Виноград</div>
                                <div>{{ implode(', ', $offer->vines->pluck('name')->toArray()) }}</div>
                            </div>
                        @endif

                        <?php if (!empty($offer['VINE'])): ?>
                        <div class="in">
                            <div>Виноград</div>
                            <?php $vine = array_shift($offer['VINE']); ?>
                            <div>
                                <a href="/catalog/<?= $offer['CATEGORY_CODE']; ?>/<?= $vine['CODE']; ?>/"><?= $vine['RUS']; ?></a>
                                <?php if (!empty($offer['VINE'])): ?>
                                <?php foreach ($offer['VINE'] as $vine): ?>
                                ,&nbsp;<a
                                    href="/catalog/<?= $offer['CATEGORY_CODE']; ?>/<?= $vine['CODE']; ?>/"><?= $vine['RUS']; ?></a>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="description">{!! $offer->wine->description !!}</div>
        </div>
        <div class="offer-container-right">
            <img src="/storage/pictures/detail/{{ $offer->wine->id }}.jpg" alt="{{ $offer->wine->original }}">
        </div>
    </div>

    <br>
    <div><a href="{{\App\Http\Routes\Web\WebRoutesProvider::reviewIndex($offer)}}">Все отзывы</a></div>
    <br>
    <div><a href="{{\App\Http\Routes\Web\WebRoutesProvider::reviewCreate($offer)}}">Написать отзыв</a></div>
    {{--    <br>--}}
    {{--    @foreach($offer->reviews as $review)--}}
    {{--        <div>--}}
    {{--            <a href="{{\App\Http\Routes\Web\WebRoutesProvider::reviewShow($offer, $review)}}">{{$review->user->name}}</a>--}}
    {{--        </div>--}}
    {{--    @endforeach--}}
@endsection
