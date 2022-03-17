@extends('layouts.my-app')

@section('title', 'Reviews')

@section('content')
    @php
        $breadcrumbs = [
        [
            'url' => '/' . \Illuminate\Support\Facades\App::getLocale(),
            'caption' => __('app.main'),
        ],
        [
           'url' => \App\Http\Routes\Web\WebRoutesProvider::offerShow($offer),
            'caption' => stripslashes($offer->wine->name),
        ],
        [
           'url' => '',
            'caption' => $review->user->name,
        ],
    ];
    @endphp

    @include('layouts.breadcrumbs')

    <div class="review-wrapper">
        <div><h1 style="font-weight: bold">{{$review->rating}}</h1></div>
        <div>{{$review->user->name}}</div>
        <div>{{$review->comment}}</div>

        @can(App\Policies\Permission::UPDATE, $review)
            <div class="form__item form__button" style="">
                <a href="{{\App\Http\Routes\Web\WebRoutesProvider::reviewEdit($offer, $review)}}" class="btn">Редактировать
                    отзыв</a>
            </div>
        @endcan

        @can(App\Policies\Permission::DELETE, $review)
            <div>
                <form action="{{\App\Http\Routes\Web\WebRoutesProvider::reviewDestroy($offer, $review)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form__item form__button" style="">
                        <button type="submit" class="btn">Удалить отзыв</button>
                    </div>
                </form>
            </div>
        @endcan
    </div>

@endsection
