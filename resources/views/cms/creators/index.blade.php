@extends('layouts.my-app')

@section('title', 'Cms Creators')

@section('content')
    <div id="creators_wrapper">
        @include('layouts.pagemenu')
        @include('table.index')
    </div>
@endsection
