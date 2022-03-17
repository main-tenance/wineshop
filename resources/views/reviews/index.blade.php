@extends('layouts.my-app')

@section('title', 'Reviews')

@section('content')
    @php
        $breadcrumbs = [
        [
            'url' => '/',
            'caption' => __('app.main'),
        ],
        [
            'url' => \App\Http\Routes\Web\WebRoutesProvider::offerShow($offer),
            'caption' => stripslashes($offer->wine->name),
        ],

    ];

    @endphp

    @include('layouts.breadcrumbs')

    <h1>Отзывы о <a
            href="{{\App\Http\Routes\Web\WebRoutesProvider::offerShow($offer)}}">{{stripslashes($offer->wine->name)}}</a>
    </h1>
    <div class="reviews_index">
        @foreach($offer->reviews as $review)
            <div>
                <a href="{{\App\Http\Routes\Web\WebRoutesProvider::reviewShow($offer, $review)}}">
                    {{$review->reting}} {{$review->user->name}}
                </a>
            </div>
        @endforeach
    </div>
@endsection
