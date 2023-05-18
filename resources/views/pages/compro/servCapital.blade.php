@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/4. Capital market service.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
        <h1>@lang('main.servecapital_title')</h1>
		</div>
	</section>
	<section  class="services-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servAuditAss') }}" >@lang('main.serveaccount_link1')</a>
						<a href="{{ route('compro.servTax') }}">@lang('main.serveaccount_link2')</a>
						<a href="{{ route('compro.servConsul') }}">@lang('main.serveaccount_link3')</a>
						<a href="{{ route('compro.servCapital') }}" class="active">@lang('main.serveaccount_link4')</a>
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
							<p>@lang('main.servecapital_detail')</p>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<!-- <p>Company access to capital in order to grant expansion or operation can be essentials things if they want to meet its short-term and long-term objective. Conventionally, capital can be enhanced by Initial Public Offerings (IPO).</p> -->
							<p>@lang('main.servecapital_des1')</p>
							<h2 class="h2-title">@lang('main.servecapital_des2')</h2>
							<p>@lang('main.servecapital_des3')</p>
							<p>@lang('main.servecapital_des4') (IPO services)</p>
							<ul>
								<li>@lang('main.servecapital_des_list1')</li>
								<li>@lang('main.servecapital_des_list2')
									<ul>
										<li>@lang('main.servecapital_des_list2_1')</li>
										<li>@lang('main.servecapital_des_list2_2')</li>
										<li>@lang('main.servecapital_des_list2_3')</li>
										<li>@lang('main.servecapital_des_list2_4')</li>
										<li>@lang('main.servecapital_des_list2_5')</li>
										<li>@lang('main.servecapital_des_list2_6')</li>
									</ul>
								</li>
								<li>@lang('main.servecapital_des_list3')
									<ul>
										<li>@lang('main.servecapital_des_list3_1')</li>
										<li>@lang('main.servecapital_des_list3_2')</li>
										<li>@lang('main.servecapital_des_list3_3')</li>
										<li>@lang('main.servecapital_des_list3_4')</li>
										<li>@lang('main.servecapital_des_list3_5')</li>
										<li>@lang('main.servecapital_des_list3_6')</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
