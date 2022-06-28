@extends('master')
@section('title', 'NFT darbs - Admin dashboard')

@section('content')

<div class="img-top-banner">
	<img src="{{ url('/images/profile_background.jpg') }}" alt="">
</div>

<section id="admin-dash" class="homepage-section">
	<div class="homepage-section-container">
		<h1>Manage user - <a href="{{route('user.profile', ['id' => $user->id])}}" class="cool-blue">{{$user->name}}</a></h1>

		<div class="open-collection-buy justify-left">
			<div class="dash-section">
				<div class="auth-header">
		            <h1 class="auth-title">
		                Edit the values you want to
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
		            <form id="auth-form" accept-charset="utf-8" action="{{action([App\Http\Controllers\AdminController::class, 'user_update'], ['id'=>$user->id]) }}" method="post">
		                @csrf @method('GET')
		                <div class="form-field">
		                    <label for="email">Email:</label>
		                    <input type="text" placeholder="email@example.com" id="email" name="email" value="{{ $user->email }}">
		                    <span class="auth-error">@error('email') {{$message}} @enderror</span>
		                </div>
		                <div class="form-field">
		                    <label for="name">Name:</label>
		                    <input type="text" placeholder="Name" id="name" name="name" value="{{ $user->name }}">
		                    <span class="auth-error">@error('name') {{$message}} @enderror</span>
		                </div>
		                <div class="form-field">
		                    <label for="balance">Balance:</label>
		                    <input type="text" placeholder="0.00" id="balance" name="balance" value="{{ $user->balance }}">
		                    <span class="auth-error">@error('balance') {{$message}} @enderror</span>
		                </div>
		                <button type="submit" class="form-btn">
		                    {{ __('Modify') }}
		                </button>
		            </form>
		        	</div>
		        </div>
			</div>
			<div class="dash-section">
				<p>Deleting the user will result in all the NFT's of said user to be removed from the user's possession.
			Other records where the user is referenced such as NFT Purchace history will be deteled.</p>
        		<a href="{{route('user.destroy', ['id' => $user->id])}}" class="btn-lonely bad">Delete user</a>
        	</div>
	</div>
</section>

@endsection