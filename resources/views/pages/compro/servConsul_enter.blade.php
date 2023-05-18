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
            <h1>@lang('main.serveenter_title')</h1>
		</div>
	</section>
	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servConsul_change') }}">@lang('main.serveconsul_link1')</a>
						<a href="{{ route('compro.servConsul_performance') }}">@lang('main.serveconsul_link2')</a>
						<a href="{{ route('compro.servConsul_enter') }}" class="active">@lang('main.serveconsul_link3')</a>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.serveenter_des1')</p>
							<p>@lang('main.serveenter_des2')</p>
							<h6>@lang('main.serveenter_des3')</h6>
							<ul>
								<li>@lang('main.serveenter_des3_list1')</li>
								<li>@lang('main.serveenter_des3_list2')</li>
								<li>@lang('main.serveenter_des3_list3')</li>
								<li>@lang('main.serveenter_des3_list4')</li>
								<li>@lang('main.serveenter_des3_list5')</li>
								<li>@lang('main.serveenter_des3_list6')</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<br>
		</div>
	</section>
@endsection
