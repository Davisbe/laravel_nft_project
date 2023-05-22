@extends('master')
@section('title', 'NFT darbs - Admin dashboard')

@section('content')

<section>
    <h1>Verify your email!</h1>
    <p>If you didn't recieve the verification email, use the button below!</p>
    @if (session('message'))
        <div id="form-success-msg">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <form class="" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="">{{ __('click here to request another') }}</button>.
    </form>
</section>

@endsection