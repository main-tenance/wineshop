@extends('layouts.my-app')

@section('title', 'Passport')

@section('content')
    <h1>{{__('passport.h1')}}</h1>
    <h2 class="passport-h2">{{ __('passport.clients') }}</h2>
    <div id="create-new-passport-client">
        <a class="btn" href="#create-passport-client" data-fancybox>{{__('passport.create-new-client')}}</a>
    </div>
    <div id="passport-clients">
        <div class="passport-client-row head">
            <div class="passport-client-name">Name</div>
            <div class="passport-client-id">Id</div>
            <div class="passport-client-secret">Secret</div>
            <div class="passport-client-redirect">Callback Url</div>
            <div class="passport-client-edit"></div>
            <div class="passport-client-delete"></div>
        </div>
    </div>
    <h2 class="passport-h2">{{__('passport.personal-tokens')}}</h2>
    <div id="create-new-personal-token">
        <a class="btn" href="#create-personal-token" data-fancybox>{{__('passport.create-new-personal-token')}}</a>
    </div>
    <div id="personal-tokens">
        <div class="personal-token-row head">
            <div class="personal-token-name">Name</div>
            <div class="personal-token-scopes">Scopes</div>
            <div class="personal-token-created_at">Created At</div>
            <div class="personal-token-expires_at">Expires At</div>
            <div class="personal-token-delete"></div>
        </div>
    </div>
@endsection

<div id="create-passport-client" class="popup passport-client-form">
    <div class="popup-inner">
        @csrf
        <div class="mb-20">
            <label for="#name">Name</label>
            <div id="name"><input type="text" name="name"></div>
        </div>
        <div class="mb-20">
            <label for="#redirect">Callback Url</label>
            <div id="redirect"><input type="text" name="redirect"></div>
        </div>
        <div class="mb-20">
            <button class="btn create-passport-client">{{__('passport.save')}}</button>
        </div>
    </div>
</div>

<div id="update-passport-client" class="popup passport-client-form">
    <div class="popup-inner">
        @csrf
        <div id="id"><input type="hidden" name="id"></div>
        <div class="mb-20">
            <label for="#name">Name</label>
            <div id="name"><input type="text" name="name"></div>
        </div>
        <div class="mb-20">
            <label for="#redirect">Callback Url</label>
            <div id="redirect"><input type="text" name="redirect"></div>
        </div>
        <div class="mb-20">
            <button class="btn update-passport-client">{{__('passport.save')}}</button>
        </div>
    </div>
</div>


<div id="create-personal-token" class="popup personal-token-form">
    <div class="popup-inner">
        @csrf
        <div class="mb-20">
            <label for="#name">Name</label>
            <div id="name"><input type="text" name="name"></div>
        </div>
        <div class="mb-20">
            <label for="#scopes">Scopes</label>
            <div id="scopes"></div>
        </div>
        <div class="mb-20">
            <button class="btn create-personal-token">{{__('passport.save')}}</button>
        </div>
    </div>
</div>

<div id="show-personal-token" class="popup">
    <div class="popup-inner">
        <div id="personal-token"></div>
    </div>
</div>
