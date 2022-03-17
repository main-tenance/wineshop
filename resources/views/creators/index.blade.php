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

    ];

    @endphp

    @include('layouts.breadcrumbs')

    <h1>{{__('creators.h1')}}</h1>
    <div class="growers_index">
        @foreach($creators as $creator)
            <div><a href="{{\App\Http\Routes\Web\WebRoutesProvider::creatorShow($creator)}}">{{$creator->name}}</a></div>
        @endforeach
    </div>
@endsection
