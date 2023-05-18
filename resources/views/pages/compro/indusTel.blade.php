@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Telecommunication.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>Telecommunications, Media and Technology</h1>
		</div>
	</section>
	<br>
	<br>
	<section class="servicesConsul-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.indusCons') }}" >Consumer, Industrial Products and Services</a>
						<a href="{{ route('compro.indusEnergy') }}">Energy, Utilities and Mining</a>
						<a href="{{ route('compro.indusFinan') }}">Financial Services</a>
						<a href="{{ route('compro.indusTel') }}" class="active">Telecommunications, Media and Technology</a>
						<a href="{{ route('compro.indusGov') }}">Government, Entertainment and Non Profit</a>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>Reanda Bernardi’s professionals work for Telecommunication, Media, and Technology companies to alleviate any issues and opportunities. We presented strategy through understanding in the areas of audit, tax, advisory, and consulting to address the changing of digital transformation and regulatory changes.</p>
							<ul>
								<li>Reanda Bernardi’s professional work to provide assurance, tax, advisory, and consulting to telecom, cable, satellite and internet companies. We can help to find the best method to achieve your goals</li>
								<li>Reanda Bernardi’s professionals has the expertise to support you to get attention in today’s multichannel media.</li>
								<li>In today’s environment, we can help you to provide solution, ensuring your business could be able to gain opportunity of changing economic situation, shifting consumer behaviors. We can deliver solution with our tech-savvy team in order to assist you in competing and growing</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<br>

	<br>
	<br>	
    @include('pages.compro.follow')

@endsection