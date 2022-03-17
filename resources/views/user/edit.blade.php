@extends('layouts.my-app')

@section('title', 'Profile')

@section('content')
    <h1>{{__('personal.h1')}}</h1>
    <div class="form std-form cabinet_form" data-url="{{$url}}" data-method="{{$form->getMethod()}}">
        @csrf
        <div class="cabinet_form__fields">
            @foreach($form->getFields() as $field)
                @include('form.' . $field['type'])
            @endforeach
        </div>
        <div class="show_errors"></div>
        <div class="cabinet_form__buttons right_align">
            <button class="btn btn--fill save">{{__('app.save_updates')}}</button>
        </div>
    </div>
@endsection
