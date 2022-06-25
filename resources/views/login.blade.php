@extends('master')
@section('title', 'NFT darbs-sign up')

@section('content')

<section id="auth-section">
    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">
                Log in!
            </h1>
        </div>
        <div class="auth-body">
            <div class="auth-form-wrapper">
            @if(Session::get('success'))
            <div id="form-success-msg">
                {{ Session::get('success') }}
            </div>
            @endif
            @if(Session::get('fail'))
            <div id="form-fail-msg">
                {{ Session::get('fail') }}
            </div>
            @endif
            <form id="auth-form" accept-charset="utf-8" action="{{ route('auth.check') }}" method="post">
                @csrf
                <div class="form-field">
                    <label for="email">Email:</label>
                    <input type="text" placeholder="email@example.com" id="email" name="email" value="{{ old('email') }}">
                    <span class="auth-error">@error('email') {{$message}} @enderror</span>
                </div>
                <div class="form-field">
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Password" id="password" name="password">
                    <span class="auth-error">@error('password') {{$message}} @enderror</span>
                </div>
                <button type="submit" class="form-btn">
                    {{ __('Log in') }}
                </button>
            </form>
        </div>
        </div>
    </div>
</section>

@endsection