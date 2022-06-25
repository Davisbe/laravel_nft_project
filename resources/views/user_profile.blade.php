@extends('master')
@section('title', 'NFT darbs-profils')

@section('content')
<section id="userprofile">
	<div class="img-top-banner">
		<img src="{{ url('/images/profile_background.jpg') }}" alt="">
	</div>
	<div class="profile-wrapper">
		<div class="profile-content">
			<div class="profile-info">
				<div class="info-block">
					<h1>
						{{ $userinfo->name }}
					</h1>
					<div>
						{{ $userinfo->email }}
					</div>
				</div>
				@if(Auth::check() && (Auth::user()->id == $userinfo->id))
				<div class="info-block">
					<div class="user-balance">
						<h2>Balance: </h2>
						${{ $userinfo->balance }}
					</div>
				</div>
				@endif
				
			</div>
			<div class="nft-list">
				<div class="user-nft-wprapper">
					<div class="user-nft-header">
						<h1>Owned NFT's</h1>
					</div>
					<div class="user-nft-list">
						@forelse ($owned_nfts as $nft)
						<article class="card">
						    <div class="inner-card">
						      	<a href="{{ url('nft/show/'.$nft->id) }}" title=""><img src="{{ url($nft->file_path) }}" alt="Bilde" class="card-img"></a>
						      		<div class="card-content">
						        		<h2>NFT #{{ $nft->name }}</h2>
						        		<p>Collection: {{ $nft->collection_name }}</p>
						      		</div>
						      		<div class="card-info">
						      			@if ($nft->price)
						        		<p class="card-price">${{ $nft->price }}</p>
						        		@endif
						      		</div>
						    </div>
						</article>
						@empty
							<p>No NFT's owned!</p>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection