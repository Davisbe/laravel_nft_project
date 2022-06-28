@extends('master')
@section('title', 'NFT darbs - Admin dashboard')

@section('content')

<div class="img-top-banner">
	<img src="{{ url('/images/profile_background.jpg') }}" alt="">
</div>

<section id="admin-dash" class="homepage-section">
	<div class="homepage-section-container">
		<h1>Manage users</h1>

		<div class="open-collection-buy justify-left">
			<div class="dash-section">
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
				<form action="" method="get" accept-charset="utf-8">
					<table class="user-table">
						<thead>
							<tr>
								<th>UserID</th>
								<th>Username</th>
								<th>Rank</th>
								<th>Balance</th>
								<th>No. of NFTs</th>
								<th>No. of buys</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td><a href="{{route('user.profile', ['id' => $user->id])}}" title="" class="cool-blue">{{$user->name}}</a></td>
								<td>{{$user->rank}}</td>
								<td>${{$user->balance}}</td>
								<td>{{$user->nft_amount}}</td>
								<td>{{$user->buy_amount}}</td>
								<td><a href="{{route('admin.user.show', ['id' => $user->id])}}" class="btn-lonely">Manage</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</section>

@endsection