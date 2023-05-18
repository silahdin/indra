@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Banner Page Audit & Assurance.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.serveauditass_title')</h1>
		</div>
	</section>
	<section  class="services-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servAuditAss') }}" class="active" >@lang('main.serveaccount_link1')</a>
						<a href="{{ route('compro.servTax') }}">@lang('main.serveaccount_link2')</a>
						<a href="{{ route('compro.servConsul') }}">@lang('main.serveaccount_link3')</a>
						<a href="{{ route('compro.servCapital') }}">@lang('main.serveaccount_link4')</a>
						<a href="{{ route('compro.servMA') }}">M & A</a>
						<a href="{{ route('compro.servAccount') }}">@lang('main.serveaccount_link5')</a>
						<a href="{{ route('compro.servTecho') }}">@lang('main.serveaccount_link6')</a>
						<a href="{{ route('compro.servFraud') }}">@lang('main.serveaccount_link7')</a>
						<a href="{{ route('compro.servEntrep') }}">@lang('main.serveaccount_link8') </a>
						<a href="{{ route('compro.servChina') }}">@lang('main.serveaccount_link9')</a>
						<a href="{{ route('compro.servJapan') }}">@lang('main.serveaccount_link10')</a>
					</div>
				</div>
				<div class="col-sm-9 col-right-service">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.serveauditass_detail')</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4">
							<div class="wrapper-services">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/service_icon/reviews.png')}}" alt="">
								<h4>@lang('main.serveauditass_title1')</h4>
								<p>@lang('main.serveauditass_subtitle1')</p>
								<a href="{{ route('compro.servAuditAss_review' ) }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wrapper-services">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/service_icon/advisory.png')}}" alt="">
								<h4>@lang('main.serveauditass_title2')</h4>
								<p>@lang('main.serveauditass_subtitle2')</p>
								<a href="{{ route('compro.servAuditAss_advisory' ) }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wrapper-services">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/service_icon/accounting.png')}}" alt="">
								<h4>@lang('main.serveauditass_title3')</h4>
								<p>@lang('main.serveauditass_subtitle3')</p>
								<a href="{{ route('compro.servAuditAss_outsourcing' ) }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



@endsection
