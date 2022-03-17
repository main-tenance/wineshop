@extends('layouts.my-app')

@section('title', 'Creators')

@section('content')
    @php
        $breadcrumbs = [
        [
            'url' => '/',
            'caption' => __('app.main'),
        ],
        [
            'url' => \App\Http\Routes\Web\WebRoutesProvider::creatorIndex(),
            'caption' => __('creators.h1'),
        ],
        [
            'url' => \App\Http\Routes\Web\WebRoutesProvider::creatorShow($creator),
            'caption' => $creator->name,
        ],
    ];
    @endphp

    @include('layouts.breadcrumbs')
    <h1>{{$creator->name}}</h1>
    <div class="creator-wrapper">
        @auth
            <button class="btn send_pdf"
                    data-url="{{\App\Http\Routes\Web\WebRoutesProvider::creatorSendPdf($creator)}}">
                {{__('creators.send-pdf-catalog.request-button')}}
            </button>
        @endauth
        <div class="creator-img">
            <img src="/storage/pictures/detail/{{ $creator->img_id }}.jpg" alt="{{ $creator->name }}">
        </div>
        <div class="creator-text">{!! $creator->description !!}</div>
    </div>
    <div class="float-clear"></div>

    @foreach($creator->offers as $offer)
        @include('offers.item')
    @endforeach
@endsection
