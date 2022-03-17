@extends('layouts.my-app')

@section('title', 'Cms Creators')

@section('content')
    <div id="creators_wrapper">
        @include('layouts.pagemenu')
        @include('form.index')
    </div>
@endsection
