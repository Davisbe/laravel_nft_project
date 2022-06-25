@extends('master')
@section('title', 'NFT darbs-sign up')

@section('content')

<section id="auth-section">
    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">
                Sign Up!
            </h1>
        </div>
        <div class="auth-body">
            <div class="auth-form-wrapper">
                @if(Session::get('fail'))
                <div id="form-error-msg">
                    {{ Session::get('fail') }}
                </div>
                @endif
            <form id="auth-form" accept-charset="utf-8" action="{{ route('auth.save') }}" method="post">
                @csrf
                <div class="form-field">
                    <label for="name">Username:</label>
                    <input type="text" placeholder="Userame" id="name" name="name" value="{{ old('name') }}">
                    <span class="auth-error">@error('name') {{$message}} @enderror</span>
                </div>
                <div class="form-field">
                    <label for="email">Email:</label>
                    <input type="text" placeholder="email@example.com" id="email" name="email" value="{{ old('email') }}">
                    <span class="auth-error">@error('email') {{$message}} @enderror</span>
                </div>
                <div class="form-field">
                    <label for="password">Passwod:</label>
                    <input type="password" placeholder="password" id="password" name="password">
                    <span class="auth-error">@error('password') {{$message}} @enderror</span>
                </div>
                <div class="form-field">
                    <label for="password_confirm">Repeat password:</label>
                    <input type="password" placeholder="repeat password" id="password_confirm" name="password_confirm">
                    <span class="auth-error">@error('password_confirm') {{$message}} @enderror</span>
                </div>
                <button type="submit" class="form-btn">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
        </div>
    </div>
</section>

@endsection