@extends('master')
@section('title', 'NFT darbs-view nft')

@section('content')

<div class="img-top-banner">
	<img src="{{ url('/images/profile_background.jpg') }}" alt="">
</div>
<section id="nft-index" class="homepage-section">
	<div class="homepage-section-container">
		<h1>NFT Marketlpace</h1>

		<div class="filter-form-div">
			<form id="filter-form" accept-charset="utf-8" action="{{action([App\Http\Controllers\NftController::class, 'index']) }}" method="post">
            @csrf @method('GET')
		        <div class="form-field left">
		            <label for="collection">Collection:</label>
		            <select name="collections" id="collection">
		            	<option value="all">All</option>
		            	@foreach ($collections as $collection)
		            		<option value="{{$collection->id}}">{{ $collection->name }}</option>
		            	@endforeach
		            </select>
		        </div>
		        <div class="form-field">
		        	<label for="is_listing">Listings</label>
		            <input type="checkbox" id="is_listing" name="is_listing" value="1">
		        </div>
		        <div class="form-field button">
		        	<button type="submit" class="btn-lonely">
			            {{ __('Filter') }}
			        </button>
		        </div>
		    </form>
		</div>
		

		<div class="user-nft-list">
			@forelse ($nfts as $nft)
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
				<p>No NFTs found.</p>
			@endforelse
		</div>
	</div>
</section>

@endsection