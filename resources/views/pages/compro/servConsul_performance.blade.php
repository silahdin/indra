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
        <h1>@lang('serveperform_title')</h1>
		</div>
	</section>
	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servConsul_change') }}">@lang('main.serveconsul_link1')</a>
						<a href="{{ route('compro.servConsul_performance') }}" class="active">@lang('main.serveconsul_link2')</a>
						<a href="{{ route('compro.servConsul_enter') }}">@lang('main.serveconsul_link3')</a>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('serveperform_des1')</p>
							<p>@lang('serveperform_des2')</p>
						</div>
					</div>
				</div>
			</div>

			<br>
		</div>
	</section>
@endsection
