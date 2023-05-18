@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/about.jpg');
?>

<div class="space-top"></div>
	<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.aboutus')</h1>
			<p>@lang('main.aboutus_title1')</p>
			<p>@lang('main.aboutus_title2')</p>
		</div>
	</section>
	<br>
	<br>
	<section>
		<div class="container about-section">
			<div class="row">
				<div class="col-sm-12">
					<h2>@lang('main.our_milestone')</h2>
					<p>@lang('main.milestone_detail')</p>
				</div>
			</div>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="about-story">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="early-years">
						<div class="sticky-wrapper">
							<div class="h-left">
								<div class="h-image">
									<img src="{{asset('assets/compro/assets/frontend_assets/images/etc/gl.jpg')}}">
									<p>@lang('main.early_year')</p>
								</div>
							</div>
						</div>
						<div class="h-right">
							<ul>
								<li class="history-box">
									<h1>1972</h1>
									<p>@lang('main.year_detail1')</p>
									<p>@lang('main.year_detail2')</p>
									<p>@lang('main.year_detail3')</p>
									<!-- <img src="http://www.sohoglobalhealth.com/uploads/history_image/image/1/jneihymcy4nhg1fww0tw.png" alt=""> -->
								</li>
							</ul>
						</div>
					</div>
					<div class="clear"></div>

					<div class="mid-years">
						<div class="sticky-wrapper">
							<div class="h-left">
								<div class="h-image">
									<img src="{{asset('assets/compro/assets/frontend_assets/images/etc/broadening-portfolio.png')}}">
									<p>@lang('main.broad_portfolio')</p>
								</div>
							</div>
						</div>
						<div class="h-right">
							<ul>
								<li class="history-box">
									<h1>1977</h1>
									<p>@lang('main.portfolio_detail1')</p>
									<img src="{{asset('assets/compro/assets/frontend_assets/images/etc/trio.jpg')}}" alt="">
								</li>
								<li class="history-box">
									<h1>1985</h1>
									<p>@lang('main.portfolio_detail2')</p>
									<!-- <img src="http://www.sohoglobalhealth.com/uploads/history_image/image/1/jneihymcy4nhg1fww0tw.png" alt=""> -->
								</li>
								<li class="history-box">
									<h1>1996</h1>
									<p>@lang('main.portfolio_detail3')</p>
									<!-- <img src="http://www.sohoglobalhealth.com/uploads/history_image/image/1/jneihymcy4nhg1fww0tw.png" alt=""> -->
								</li>
							</ul>
						</div>
					</div>
					<div class="clear"></div>

					<div class="end-years">
						<div class="sticky-wrapper">
							<div class="h-left">
								<div class="h-image">
									<img src="{{asset('assets/compro/assets/frontend_assets/images/etc/new-era.png')}}">
									<p>@lang('main.era_reanda')</p>
								</div>
							</div>
						</div>
						<div class="h-right">
							<ul>
								<li class="history-box">
									<h1>2012</h1>
									<p>@lang('main.reanda_history')</p>
									<img src="{{asset('assets/compro/assets/frontend_assets/images/etc/deal.jpg')}}" alt="">
								</li>
							</ul>
						</div>
					</div>
					<div class="clear"></div>

				</div>
			</div>
		</div>
	</section>
	<div class="detect-end"></div>

	<div class="container about-section">
		<div class="row">
			<div class="col-sm-12">
				<h2>@lang('main.core_value')</h2>
				<p>@lang('main.core_detail')</p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<h2>@lang('main.banking_partner')</h2>
				<br>
				<section class="regular slider">
				    <div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/ojk.png') }}">
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/kemen.png') }}" style="width: 150px !important" >
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/idx.png') }}" style="width: 100px !important" >
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/djp.jpg') }}">
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/bni.png') }}">
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/bri.png') }}" >
							</span>
						</div>
					</div>
					<div>
						<div>
							<span>
								<img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/bpk.png') }}" >
							</span>
						</div>
					</div>

				</section>

				<?php /*<div class="flex-box partner-bank">
					<div class="box"><img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/bri.png') }}" alt=""></div>
					<div class="box"><img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/kemen.png') }}" alt=""></div>
					<div class="box"><img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/djp.jpg') }}" alt=""></div>
					<div class="box"><img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/ojk.png') }}" alt=""></div>
					<div class="box"><img src="{{ asset('assets/compro/assets/frontend_assets/images/partner_bank/bni.png') }}" alt=""></div>
				</div>*/ ?>
				<br>
				<br>
			</div>
		</div>
	</div>
	<br>
	<br>

<script>

$(document).ready(function () {
			var ended = $('.detect-end').offset().top-419.5;
			var early = $('.early-years .sticky-wrapper').offset().top;
			var mid = $('.mid-years .sticky-wrapper').offset().top;
			var now = $('.end-years .sticky-wrapper').offset().top;
			$(window).scroll(function (event) {
				var scroll = $(window).scrollTop();
				console.log(scroll);
				console.log(early);
				console.log('ended = '+ended);

				// var y = $(this).scrollTop();
				if (scroll+135 >= early){
					console.log('sampai A');
					$('.early-years .sticky-wrapper').addClass('fixed-history');
				}else{
					$('.early-years .sticky-wrapper').removeClass('fixed-history');
				}
				if (scroll+135 >= mid){
					console.log('sampaii B');
					$('.mid-years .sticky-wrapper').addClass('fixed-history');
				}else{
					$('.mid-years .sticky-wrapper').removeClass('fixed-history');
				}
				if (scroll+135 >= now){
					console.log('sampaii C');
					$('.end-years .sticky-wrapper').addClass('fixed-history');
				}else{
					$('.end-years .sticky-wrapper').removeClass('fixed-history');
				}
				if (scroll >= ended){
					console.log('sampaii E');
					// $('.end-years .sticky-wrapper').addClass('fixed-history');
					$('.early-years .sticky-wrapper').removeClass('fixed-history');
					$('.mid-years .sticky-wrapper').removeClass('fixed-history');
					$('.end-years .sticky-wrapper').removeClass('fixed-history');
				}else{

				}
			});

		});
</script>

	<br>
	<br>
    @include('pages.compro.follow')

@endsection
