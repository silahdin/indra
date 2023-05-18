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
			<h1>@lang('main.serveoutsourcing_title')</h1>
		</div>
	</section>
	<section >
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box nav-serv-audit">
						<a href="{{ route('compro.servAuditAss_review') }}">@lang('main.serveoutsourcing_link1')</a>
						<a href="{{ route('compro.servAuditAss_advisory') }}">@lang('main.serveoutsourcing_link2')</a>
						<a href="{{ route('compro.servAuditAss_outsourcing') }}" class="active">@lang('main.serveoutsourcing_link3')</a>
					</div>
				</div>
				<div class="col-sm-9 col-right-service">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.serveoutsourcing_detail')</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2 class="h2-title">
								@lang('main.serveoutsourcing_subtitle')
							</h2>
							<br>
							<h5 class="h5-title">@lang('main.serveoutsourcing_book_keeping')</h5>
							<!-- <div class="container"> -->
								<div class="row">
									<div class="col-sm-12">
										<p>
											@lang('main.serveoutsourcing_book_keeping_detail1')
										</p>
										<p>
											@lang('main.serveoutsourcing_book_keeping_detail1')
										</p>
									</div>
								</div>
							<!-- </div> -->
							<br>

							<h5 class="h5-title">@lang('main.serveoutsourcing_account_design')</h5>
							<!-- <div class="container"> -->
								<div class="row">
									<div class="col-sm-12">
										<p>
											@lang('main.serveoutsourcing_account_design_detail')
										</p>
									</div>
								</div>
							<!-- </div> -->
							<br>
							<h5 class="h5-title">@lang('main.serveoutsourcing_account_complication')</h5>
							<!-- <div class="container"> -->
								<div class="row">
									<div class="col-sm-12">
										<p>@lang('main.serveoutsourcing_account_complication_detail')</p>
									</div>
								</div>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
