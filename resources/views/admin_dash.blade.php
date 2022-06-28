@extends('master')
@section('title', 'NFT darbs - Admin dashboard')

@section('content')

<div class="img-top-banner">
	<img src="{{ url('/images/profile_background.jpg') }}" alt="">
</div>

<section id="admin-dash" class="homepage-section">
	<div class="homepage-section-container">
		<h1>Admin dashboard</h1>

		<div class="open-collection-buy justify-left">
			<div class="dash-section">
				<h2>Manage users:</h2>
            	<a href="{{ url('admin/user/manage/users') }}" class="btn-lonely">Manage</a>
			</div>
			<div class="dash-section">
				<h2>Manage collections:</h2>
            	<a href="" class="btn-lonely">Manage</a>
			</div>
		</div>
	</div>
</section>

@endsection