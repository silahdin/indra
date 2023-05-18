@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Consumer.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
            <h1>@lang('main.indus_consumer')</h1>
		</div>
	</section>
	<br>
	<br>
	<section class="servicesConsul-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.indusCons') }}" class="active">@lang('main.indus_consumer')</a>
						<a href="{{ route('compro.indusEnergy') }}">@lang('main.indus_energy')</a>
						<a href="{{ route('compro.indusFinan') }}">@lang('main.indus_finalcial')</a>
						<!--<a href="{{ route('compro.indusTel') }}">Telecommunications, Media and Technology</a>-->
						<a href="{{ route('compro.indusGov') }}">@lang('main.indus_government')</a>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.indus_title1')</p>
							<p>@lang('main.indus_title2')</p>
							<p>@lang('main.indus_title3'):</p>
							<ul class="ul-pad-L-0">
								<li>@lang('main.indus_accounting')
									<ul>
										<li>@lang('main.indus_account_outsource')</li>
										<li>@lang('main.indus_finalcial_state')</li>
										<li>@lang('main.indus_advisory_service')</li>
									</ul>
								</li>
								<br>
								<li>@lang('main.indus_fraud')
									<ul>
										<li>@lang('main.indus_fraud_service')</li>
									</ul>
								</li>
								<br>
								<li>@lang('main.indus_manage')
									<ul>
										<li>@lang('main.indus_manage_change')</li>
										<li>@lang('main.indus_perform_improve')</li>
										<li>@lang('main.indus_risk_service')</li>
									</ul>
								</li>
								<br>
								<li>@lang('main.indus_tax')
									<ul>
										<li>@lang('main.indus_tax_advisory')</li>
										<li>@lang('main.indus_internation')</li>
									</ul>
								</li>
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
