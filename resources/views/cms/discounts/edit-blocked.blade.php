@extends('layouts.my-app')

@section('title', 'Cms Discounts')

@section('content')
    <div id="creators_wrapper">
        @include('layouts.pagemenu')
        <h3>{{__('discounts.edit-blocked')}}</h3>
    </div>
@endsection
