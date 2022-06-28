@extends('master')
@section('title', 'NFT darbs - homepage')

@section('content')

<section id="intro" class="homepage-section header">
    <div class="homepage-section-container">
        <h1>The NFT Marketplace</h1>
        <h2>"ha ha the crypto prices crashed, what are you gonna do now?"</h2>
        <h3>~probably your friends and family</h3>
    </div>
</section>

@if (count($open_collections) > 0)
<section id="open_collections" class="homepage-section">
    <div class="homepage-section-container">
        <h1>Buy newly released NFTs</h1>
        <h2>(NFT collections that have released, but haven't sold out their NFTs to the market)</h1>
        <div class="user-nft-list">
            @forelse ($open_collections as $collection)
            <a href="{{ url('collection/view/new/'.$collection->collection_id) }}" title="">
            <article class="card">
                <div class="inner-card">
                    <div class="card-content">
                        <h2>{{ $collection->collection_name }}</h2>
                    </div>
                </div>
            </article>
            </a>
            @empty
                <p>No NFT's owned!</p>
            @endforelse
        </div>
    </div>
</section>
@endif

@endsection