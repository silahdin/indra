@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/3. Consulting.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
        <h1>@lang('main.serveconsul_header')</h1>
		</div>
	</section>
	<section  class="services-page servicesConsul-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servAuditAss') }}" >@lang('main.serveaccount_link1')</a>
						<a href="{{ route('compro.servTax') }}">@lang('main.serveaccount_link2')</a>
						<a href="{{ route('compro.servConsul') }}" class="active">@lang('main.serveaccount_link3')</a>
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
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.serveconsul_detail')</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="wrapper-serConsul ">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/consul/Change Management.png')}}" alt="">
								<h4 class="text-center">@lang('main.serveconsul_link1')</h4>
								<p style="text-align:justify">@lang('main.serveconsul_subtitle1')</p>
								<a href="{{ route('compro.servConsul_change') }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wrapper-serConsul">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/consul/Performance Improvement.png')}}" alt="">
								<h4 class="text-center">@lang('main.serveconsul_link2')</h4>
								<p style="text-align:justify">@lang('main.serveconsul_subtitle2')</p>
								<a href="{{ route('compro.servConsul_performance') }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wrapper-serConsul">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/consul/Enterprise Risk Management.png')}}" alt="">
								<h4 class="text-center">@lang('main.serveconsul_link3')</h4>
								<p style="text-align:justify">@lang('main.serveconsul_subtitle3')</p>
								<a href="{{ route('compro.servConsul_enter') }}" class="btn">@lang('main.serveauditass_discover')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
