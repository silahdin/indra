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
			<h1>@lang('main.serveaudit_title')</h1>
		</div>
	</section>
	<section >
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box nav-serv-audit">
						<a href="{{ route('compro.servAuditAss_review') }}" >@lang('main.serveaudit_link1')</a>
						<a href="{{ route('compro.servAuditAss_advisory') }}" class="active">@lang('main.serveaudit_link2')</a>
						<a href="{{ route('compro.servAuditAss_outsourcing') }}">@lang('main.serveaudit_link3')</a>
					</div>
				</div>
				<div class="col-sm-9 col-right-service">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.serveaudit_detail')</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2 class="h2-title">@lang('main.serveaudit_subtitle1')</h2>
							<ul>
								<li>@lang('main.serveaudit_subtitle1_list1')</li>
								<li>@lang('main.serveaudit_subtitle1_list2')
								</li>
								<li>@lang('main.serveaudit_subtitle1_list3')</li>
								<li>@lang('main.serveaudit_subtitle1_list4')</li>
							</ul>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-sm-12">
							<h2 class="h2-title">@lang('main.serveaudit_subtitle2')</h2>
							<p>@lang('main.serveaudit_subtitle2_description1')</p>
							<ul>
								<li>@lang('main.serveaudit_subtitle2_description1_list1')</li>
								<li>@lang('main.serveaudit_subtitle2_description1_list2')</li>
							</ul>
							<!-- <p>Accounting regulatory advice on Indonesian GAAP and IFRS</p>
							<p>Knowledge sharing through accounting seminars and trainings</p> -->
							<p style="margin-bottom:0">@lang('main.serveaudit_subtitle2_description2')</p>
							<ul>
								<li>@lang('main.serveaudit_subtitle2_description2_list1')</li>
								<li>@lang('main.serveaudit_subtitle2_description2_list2')</li>
								<li>@lang('main.serveaudit_subtitle2_description2_list3')</li>
								<li>@lang('main.serveaudit_subtitle2_description2_list4')</li>
								<li>@lang('main.serveaudit_subtitle2_description2_list5')</li>
							</ul>
							<p style="margin-bottom:0">@lang('main.serveaudit_subtitle2_description3')</p>
							<ul>
								<li>@lang('main.serveaudit_subtitle2_description3_list1')</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
