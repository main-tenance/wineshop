@extends('layouts.my-app')

@section('title', 'Passport')

@section('content')
    <div class="passport-authorize">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-body">
                            <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>
                            @if (count($scopes) > 0)
                                <div class="scopes">
                                    <p><strong>This application will be able to:</strong></p>
                                    <ul>
                                        @foreach ($scopes as $scope)
                                            <li>{{ $scope->description }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="buttons">
                                <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                    @csrf
                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                    <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                                </form>
                                <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                    <button class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
