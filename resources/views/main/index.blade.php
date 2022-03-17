@extends('layouts.my-app')

@section('title', 'Main')

@section('content')

    @include('main.banner')

    <h1 id="main_h1">{{__('main.h1')}}</h1>

    @include('main.benefits')

    @include('main.categories')

@endsection
