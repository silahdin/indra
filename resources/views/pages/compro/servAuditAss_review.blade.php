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
			<h1>@lang('main.servereview_title')</h1>
		</div>
	</section>
	<section >
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box nav-serv-audit">
						<a href="{{ route('compro.servAuditAss_review') }}" class="active">@lang('main.serveoutsourcing_link1')</a>
						<a href="{{ route('compro.servAuditAss_advisory') }}">@lang('main.serveoutsourcing_link2')</a>
						<a href="{{ route('compro.servAuditAss_outsourcing') }}">@lang('main.serveoutsourcing_link3')</a>
					</div>
				</div>
				<div class="col-sm-9 col-right-service">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.servereview_detail')</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2 class="h2-title">@lang('main.servereview_subtitle1') </h2>
							<ul>
								<li>@lang('main.servereview_subtitle1_list1')</li>
								<li>@lang('main.servereview_subtitle1_list2')</li>
								<li>@lang('main.servereview_subtitle1_list3')</li>
								<li>@lang('main.servereview_subtitle1_list4')</li>
							</ul>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-sm-12">
							<h2 class="h2-title">@lang('main.servereview_subtitle2')</h2>
							<p>@lang('main.servereview_subtitle2_description')</p>
							<ul>
								<li>@lang('main.servereview_subtitle2_list1')</li>
								<li>@lang('main.servereview_subtitle2_list2')</li>
								<li>@lang('main.servereview_subtitle2_list3')</li>
								<li>@lang('main.servereview_subtitle2_list4')</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
