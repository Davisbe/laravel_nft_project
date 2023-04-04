@extends('master')
@section('title', 'NFT darbs-view nft')

@section('content')

<section id="view-nft">
	<div class="profile-wrapper">
		<div class="profile-content">
			<div class="profile-info">
				<div class="info-block">
					<article class="card">
					    <div class="inner-card">
					      	<img src="{{ url($nftinfo->file_path) }}" alt="Bilde" class="card-img">
					    </div>
					</article>
				</div>
				
			</div>
			<div class="nft-list">
				<div class="user-nft-wprapper">
					<div class="user-nft-header">
						<div class="nft-name">
							<h1>NFT #{{ $nftinfo->name }}</h1>
						</div>
						<div class="nft-collection">
							<h2>Collection: {{ $nftinfo->collection_name }}</h2>
						</div>
						<div class="nftinfo-block">
							<h2>Owner: {{ $nftinfo->owner_name }}</h2>
						</div>
						@if ($nftinfo->price)
						<div class="nftinfo-block">
							<h2>Price: ${{ $nftinfo->price }}</h2>
						</div>
						@endif
						@if (Auth::check())
							@if ((Auth::user()->id == $nftinfo->owner) && $nftinfo->price)
							<div class="nftinfo-block border-top">
								<h2>Update listing price:</h2>
								<form action="{{ url('nft/listing/update/'.$nftinfo->id) }}" method="get" accept-charset="utf-8">
									@csrf
									<div class="form-field">
					                    <input type="text" placeholder="$0.00" id="price" name="price" value="{{ $nftinfo->price }}">
					                    <button type="submit" class="form-btn">
						                    {{ __('List NFT') }}
						                </button>
					                </div>
					                <span class="auth-error">@error('price') {{$message}} @enderror</span>
					            </form>
				                <form action="{{ url('nft/listing/remove/'.$nftinfo->id) }}" method="get" accept-charset="utf-8">
									@csrf
									<div class="form-field-lonely bad">
					                    <button type="submit" class="form-btn-lonely bad">
						                    {{ __('Remove listing') }}
						                </button>
					                </div>
					                <span class="auth-error">@error('transaction') {{$message}} @enderror</span>
								</form>
							</div>
							@elseif (Auth::user()->id == $nftinfo->owner)
							<div class="nftinfo-block border-top">
								<h2>List NFT on the marketplace:</h2>
								<form action="{{ url('nft/listing/store/'.$nftinfo->id) }}" method="get" accept-charset="utf-8">
									@csrf
									<div class="form-field">
					                    <input type="text" placeholder="$0.00" id="price" name="price" value="{{ old('price') }}">
					                    <button type="submit" class="form-btn">
						                    {{ __('List NFT') }}
						                </button>
					                </div>
					                <span class="auth-error">@error('price') {{$message}} @enderror</span>
								</form>
							</div>
							@elseif ((Auth::user()->id != $nftinfo->owner) && $nftinfo->price)
							<div class="nftinfo-block border-top">
								<form action="{{ url('nft/listing/transaction/'.$nftinfo->id) }}" method="get" accept-charset="utf-8">
									@csrf
									<div class="form-field-lonely">
					                    <button type="submit" class="form-btn-lonely">
						                    {{ __('Purchace for $'.$nftinfo->price) }}
						                </button>
					                </div>
					                <span class="auth-error">@error('price') {{$message}} @enderror</span>
								</form>
							</div>
							

							@endif
						@elseif ($nftinfo->price && !Auth::check())

						<div class="nftinfo-block">
							<form action="{{ url('nft/listing/transaction/'.$nftinfo->id) }}" method="get" accept-charset="utf-8">
								@csrf
								<div class="form-field-lonely">
				                    <button type="submit" class="form-btn-lonely">
					                    {{ __('Purchace for $'.$nftinfo->price) }}
					                </button>
				                </div>
				                <span class="auth-error">@error('transaction') {{$message}} @enderror</span>
							</form>
						</div>

						@endif
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
			            @if (count($nfthistory) > 0)
			            <div class="nftinfo-block border-top">
			            	<h2>NFT order history:</h2>
							<ul class="nft-history">
								@foreach ($nfthistory as $record)
									<li>
										<div class="nft-history-info">
											Bought by <a href="{{ url('profile/user/'.$record->user) }}" title="">{{$record->user_name}}</a> for ${{$record->price}}
										</div>
										<div class="nft-history-date">
											{{$record->created_at}}
										</div>
									</li>
								@endforeach
							</ul>
						</div>
						@endif

						@if (Auth::check())
						<div class="nftinfo-block" id="comments">
			            	<h2>Comments</h2>
							<div class="comment-wrapper-new">
								<form id="auth-form" accept-charset="utf-8" action="{{ url('comments/'.$nftinfo->id) }}" method="POST">
									@csrf
									<div class="form-field">
										<textarea placeholder="Write comment" name="comment" cols="40" rows="5"></textarea>
										<span class="auth-error">@error('comment') {{$message}} @enderror</span>
									</div>
									<button type="submit" class="form-btn">
										{{ __('Submit') }}
									</button>
								</form>
							</div>

							@forelse ($nftinfo->comments as $comment)
							<div class="comment-wrapper">
								<div class="comment-info">

									<div class="comment-owner">
										@if ($comment->user)
											{{ $comment->user->name }}
										@endif
									</div>
									<div class="comment-date">
										{{ $comment->created_at->format('d-m-y') }}
									</div>

								</div>

								<div class="comment-body">
									<p>{{ $comment->body }}</p>
								</div>

							</div>

							@empty
							<div class="comment-wrapper">
								<div class="comment-info">

									<div class="comment-owner">
									</div>
									<div class="comment-date">
									</div>

								</div>

								<div class="comment-body">
									<p>No comments yet.</p>
								</div>

							</div>
							@endforelse

							
						</div>

						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection