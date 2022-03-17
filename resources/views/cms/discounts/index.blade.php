@extends('layouts.my-app')

@section('title', 'Cms Discounts')

@section('content')
    <div id="creators_wrapper">
        @include('layouts.pagemenu')
        @include('table.index')
    </div>
@endsection
