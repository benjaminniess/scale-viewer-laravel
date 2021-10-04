@extends('layouts.default')


@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label class="label" for="email">Email</label>
            <div class="control">
                <input id="email" type="email" class="input" @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" autofocus required>
            </div>

            @error('email')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="password">Password</label>
            <div class="control">
                <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                       name="password" required>
            </div>

            @error('password')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Login</button>
            </div>

            <div class="control">
                <button type="button" id="google-connect-button" class="button is-link">Login with Google</button>
            </div>

            @if (Route::has('password.request'))
                <div class="control">
                    <a href="{{ route('password.request') }}" class="button is-light">Forgot your password?</a>
                </div>
            @endif
        </div>
    </form>

@endsection
