@extends('master')
@section('title', 'NFT darbs - open collection')

@section('content')
<div class="img-top-banner">
	<img src="{{ url('/images/profile_background.jpg') }}" alt="">
</div>
<section id="open-collection" class="homepage-section">
	<div class="homepage-section-container">
		<h1>{{ $collection->name }}</h1>

		<div class="open-collection-buy justify-left">
			<h2>Buy a randomly selected nft from the {{ $collection->name }} collection. After the purchace, the NFT will be added to your profile.</h2>
			<h2>NFTs left: <span class="cool-blue">{{ $collection->open_count }}</span></h2>
			<h2>Price: ${{ $collection->initial_price }}</h2>
			<form action="{{ url('collection/view/new/purchace/'.$collection->id) }}" method="get" accept-charset="utf-8">
				@csrf
				<div class="form-field-lonely">
                    <button type="submit" class="form-btn-lonely">
	                    {{ __('Purchace for $'.$collection->initial_price) }}
	                </button>
                </div>
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
			</form>
		</div>
	</div>
</section>

@endsection