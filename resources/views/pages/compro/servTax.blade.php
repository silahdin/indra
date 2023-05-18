@extends('layouts.appcompro')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/compro/assets/frontend_assets/js/animatedModal.min.js') }}"></script>

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/2. Tax.jpg');
?>
	<div class="space-top">
	</div>
	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.servetax_title')</h1>
		</div>
	</section>
	<section  class="services-page tax-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="nav-services flex-box">
						<a href="{{ route('compro.servAuditAss') }}" >@lang('main.serveaccount_link1')</a>
						<a href="{{ route('compro.servTax') }}" class="active">@lang('main.serveaccount_link2')</a>
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
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12">
							<p>@lang('main.servetax_detail1')</p>
							<p>@lang('main.servetax_detail2')</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo01" href="#animatedModal-1" src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/Tax Compliance.png')}}" alt="">
								<h2 class="cool-link demo01" href="#animatedModal-1">@lang('main.servetax_header1')</h2>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo02" href="#animatedModal-2"
									src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/TAx Advisory.png')}}" alt="">
								<h2 class="demo02" href="#animatedModal-2">@lang('main.servetax_header2')</h2>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo03" href="#animatedModal-3"
									src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/Tax Dispute Resolution.png')}}" alt="">
								<h2 class="demo03" href="#animatedModal-3">@lang('main.servetax_header3')</h2>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo04" href="#animatedModal-4"
									src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/Transfer Pricing.png')}}" alt="">
								<h2 class="demo04" href="#animatedModal-4">@lang('main.servetax_header4')</h2>
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo05" href="#animatedModal-5" src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/VAT.png')}}"
									alt="">
								<h2 class="demo05" href="#animatedModal-5">@lang('main.servetax_header5')</h2>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo06" href="#animatedModal-6"
									src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/Custom.png')}}" alt="">
								<h2 class="demo06" href="#animatedModal-6">@lang('main.servetax_header6')</h2>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="wrap">
								<img class="demo07" href="#animatedModal-7"
									src="{{asset('assets/compro/assets/frontend_assets/images/iconTax/Global Tax Assignment.png')}}" alt="">
								<h2 class="demo07" href="#animatedModal-7">@lang('main.servetax_header7')</h2>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>



	<div id="animatedModal-1">
		<div class="close-animatedModal-1">
			<div id="closebt-container" class="close-animatedModal-1">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle1')</h4>
						<h5>@lang('main.servetax_subtitle1_content1')</h5>
						<p>@lang('main.servetax_subtitle1_content2')</p>
						<label for="">* @lang('main.servetax_subtitle1_content3')</label>
						<br />
						<label for="">* @lang('main.servetax_subtitle1_content4')</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-2">
		<div class="close-animatedModal-2">
			<div id="closebt-container" class="close-animatedModal-2">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle2')</h4>
						<p>@lang('main.servetax_subtitle2_content1')</p>
						<h5>@lang('main.servetax_subtitle2_content2')</h5>
						<p>@lang('main.servetax_subtitle2_content3')</p>
						<ul>
							<li>@lang('main.servetax_subtitle2_list1')</li>
							<li>@lang('main.servetax_subtitle2_list2')</li>
							<li>@lang('main.servetax_subtitle2_list3')</li>
							<li>@lang('main.servetax_subtitle2_list4')</li>
							<li>@lang('main.servetax_subtitle2_list5')</li>
							<li>@lang('main.servetax_subtitle2_list6')</li>
							<li>@lang('main.servetax_subtitle2_list7')</li>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-3">
		<div class="close-animatedModal-3">
			<div id="closebt-container" class="close-animatedModal-3">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle3')</h4>
						<h5>@lang('servetax_subtitle3_content1')</h5>
						<p>@lang('servetax_subtitle3_content2')</p>
						<ul>
							<li>@lang('servetax_subtitle3_list1')</li>
							<li>@lang('servetax_subtitle3_list2')</li>
							<li>@lang('servetax_subtitle3_list3')</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-4">
		<div class="close-animatedModal-4">
			<div id="closebt-container" class="close-animatedModal-4">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle4')</h4>
						<p>@lang('servetax_subtitle4_content1')</p>
						<h5>@lang('servetax_subtitle4_content2')</h5>
						<p>@lang('servetax_subtitle4_content3')</p>
						<ul>
							<li>@lang('servetax_subtitle4_list1')</li>
							<li>@lang('servetax_subtitle4_list2')</li>
							<li>@lang('servetax_subtitle4_list3')</li>
							<li>@lang('servetax_subtitle4_list4')</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-5">
		<div class="close-animatedModal-5">
			<div id="closebt-container" class="close-animatedModal-5">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle5')</h4>
						<h5>@lang('servetax_subtitle5_content1')</h5>
						<p>@lang('servetax_subtitle5_content2')</p>
						<ul>
							<li>@lang('servetax_subtitle5_list1')</li>
							<li>@lang('servetax_subtitle5_list2')</li>
							<li>@lang('servetax_subtitle5_list3')</li>
							<li>@lang('servetax_subtitle5_list4')</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-6">
		<div class="close-animatedModal-6">
			<div id="closebt-container" class="close-animatedModal-6">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle6')</h4>
						<h5>@lang('servetax_subtitle6_content1')</h5>
						<p>@lang('servetax_subtitle6_content2')</p>
						<ul>
							<li>@lang('servetax_subtitle6_list1')</li>
							<li>@lang('servetax_subtitle6_list2')</li>
							<li>@lang('servetax_subtitle6_list3')</li>
							<li>@lang('servetax_subtitle6_list4')</li>
							<li>@lang('servetax_subtitle6_list5')</li>
							<li>@lang('servetax_subtitle6_list6')</li>
							<li>@lang('servetax_subtitle6_list7')</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="animatedModal-7">
		<div class="close-animatedModal-7">
			<div id="closebt-container" class="close-animatedModal-7">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">@lang('servetax_subtitle7')</h4>
						<p>@lang('servetax_subtitle7_content1')</p>
						<p>@lang('servetax_subtitle7_content2')</p>
						<p>@lang('servetax_subtitle7_content3')</p>
						<ul>
							<li>@lang('servetax_subtitle7_list1')</li>
							<li>@lang('servetax_subtitle7_list2')</li>
							<li>@lang('servetax_subtitle7_list3')</li>
							<li>@lang('servetax_subtitle7_list4')</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">
    $(document).ready(function () {
        $(".demo01").animatedModal();
        $(".demo02").animatedModal();
        $(".demo03").animatedModal();
        $(".demo04").animatedModal();
        $(".demo05").animatedModal();
        $(".demo06").animatedModal();
        $(".demo07").animatedModal();
    });
</script>


@endsection
