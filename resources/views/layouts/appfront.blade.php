<?php
$footerTrain = DB::table('cms_training')
->where('rowstate', 1)
->orderBy('id', 'ASC')
->get();

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Login - Recare</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:site_name" content="http://recare.co.id" />
    <meta property="og:description" content="Training profesional" />


	<link rel="icon" href="{{ asset('assets/compro/assets/frontend_assets/images/fav.png') }}" type="image/x-icon" />

	<!-- <link href="{{ asset('assets/compro/assets/frontend_assets/css/owl/owl.carousel.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/compro/assets/frontend_assets/css/owl/owl.theme.default.min.css') }}" rel="stylesheet"/> -->

    <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet"/>
	<link rel="icon" href="./assets/compro/images/logo/fav.png" type="image/x-icon"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'/>
	<!-- <link rel="stylesheet" type="text/css" href="assets/compro/css/slick-theme.css" /> -->
    <link href="{{ asset('assets/compro/assets/frontend_assets/css/slick-theme.css') }}" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<!-- <link rel='stylesheet' href='./assets/compro/css/style.css'> -->
    <link href="{{ asset('assets/compro/assets/frontend_assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/compro/assets/frontend_assets/css/style_plus.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/compro/assets/frontend_assets/css/media_query.css') }}" rel="stylesheet"/>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css"/>
    <script src="{{ asset('assets/compro/assets/frontend_assets/js/jquery/jquery.js') }}"></script>

    @stack('styles')

</head>
<style>
.language .actived a{
    border-bottom: 1px solid #fff;
    text-decoration: none;
}
.btn-primary {
    color: #fff;
    background-color: #0cb9b5;
    border-color: #0cb9b5;
}
</style>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119897347-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-119897347-1');
</script>

<body>


<header class="head-mobile">
		<nav class="top">
			<div class="flex-box wrap">
			
				<a href="{{ route('compro.contact') }}">@lang('main.services_list_contact')</a>
			</div>
		</nav>
		<nav class="bottom">
			<div class="flex-box wrap">
				<a href="{{ route('compro.home') }}"><img src="{{asset('assets/compro/assets/frontend_assets/images/logo/ab.png')}}" alt=""></a>
				<span class="show-menu fa fa-bars"></span>
			</div>
		</nav>
	</header>

	<header class="menu-mobile">
		<nav class="">
			<ul>
				<li>
					<span href="" class="hide-menu fa fa-times"></span>
					<br>
				</li>
				<li class="m-parents-about">
					<a href="#">@lang('main.menu_about')</a>
					<ul class="">
						<li><a href="{{ route('compro.reandaInternational') }}">@lang('main.menu_about_1')</a> </li>
						<li><a href="{{ route('compro.AboutUs') }}">@lang('main.menu_about_3')</a></li>
						<li><a href="{{ route('compro.TL') }}">@lang('main.menu_about_5')</a></li>
					</ul>
					<span class="arrow arrow-top-about fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-service">
					<a href="#">@lang('main.menu_service')</a>
					<ul>
            <li><a href="{{ route('compro.servAuditAss') }}">Audit & Assurance </a></li>
            <li><a href="{{ route('compro.servTax') }}">Tax </a></li>
            <li><a href="{{ route('compro.servConsul') }}">Consulting </a> </li>
            <li><a href="{{ route('compro.servCapital') }}">Capital Market Services </a></li>
            <li><a href="{{ route('compro.servMA') }}">Merge & Acquisitions </a> </li>
            <li><a href="{{ route('compro.servAccount') }}">Accounting & Advisory Service </a></li>
            <li><a href="{{ route('compro.servTecho') }}">Technology & Operations Service </a></li>
            <li><a href="{{ route('compro.servFraud') }}">Fraud Services </a></li>
            <li><a href="{{ route('compro.servEntrep') }}">Entrepreneurial Services </a></li>
            <li><a href="{{ route('compro.servChina') }}">China Business Desk </a></li>
            <li><a href="{{ route('compro.servJapan') }}">Japan Business Desk </a></li>
					</ul>
					<span class="arrow arrow-top-service fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-indus">
					<a href="#">@lang('main.menu_industry')</a>
					<ul class="">
						<li><a href="{{ route('compro.indusCons') }}">@lang('main.menu_industry_1')</a></li>
						<li><a href="{{ route('compro.indusEnergy') }}">@lang('main.menu_industry_2')</a></li>
						<li><a href="{{ route('compro.indusFinan') }}">@lang('main.menu_industry_3')</a> </li>
						<li><a href="{{ route('compro.indusGov') }}">@lang('main.menu_industry_4')</a> </li>
					</ul>
					<span class="arrow arrow-top-indus fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-news">
					<a href="#">@lang('main.menu_newsroom')</a>
					<ul class="">
						<li><a href="{{ route('compro.mediaCenter') }}">@lang('main.menu_newsroom_1')</a></li>
						<li class="">
							<a href="{{ route('compro.publications') }}">@lang('main.menu_newsroom_2')</a>
							<ul class="m-parents-pub">
								<li><a href="{{ route('compro.pubTax') }}">@lang('main.menu_newsroom_3')</a></li>
								<li><a href="{{ route('compro.pubPrim') }}">@lang('main.menu_newsroom_4')</a></li>
								<li><a href="{{ route('compro.pubAn') }}">@lang('main.menu_newsroom_5')</a></li>
								<li><a href="{{ route('compro.pubCon') }}">@lang('main.menu_newsroom_6')</a></li>
								<li><a href="{{ route('compro.pubDB') }}">@lang('main.menu_newsroom_7')</a></li>
							</ul>
							<span class="arrow-top-pub arrow fa fa-chevron-down"></span>
						</li>
					</ul>
					<span class="arrow arrow-top-news fa fa-chevron-down"></span>
				</li>
				<li class="">
					<a href="{{ route('compro.career') }}">@lang('main.menu_career') </a>
				</li>
				<li>
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				</li>
			</ul>
		</nav>
		<div class="shadow"></div>
	</header>

	<header class="head-desktop">
        <nav class="navbar navbar-expand-lg fixed-top up-nav">
            <div class="container">
                <div class="flex-box flex-end">
                    <div class="menu-login">
                        <div class="flex-box">
                            <a href="{{ route('login') }}">@lang('main.services_list_login')</a>
                            <a class="space-a"> | </a>
                            <a href="{{ route('compro.contact') }}">@lang('main.services_list_contact')</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top btm-nav">
			<div class="container">
				<div class="top-menus">
					<div class="flex-box">
						<div class="box">
							<a class="navbar-brand" href="{{ route('compro.home') }}">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/logo/ab.png')}}" alt="" width="250">
								<div class="logo-text">
									<!-- <span>What is this</span>
									<span>What is this</span> -->
								</div>
							</a>
						</div>
						<div class="form-inline ">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="bottom-menus">
					<div class="flex-box">
						<ul class="root-menu">
							<li>
								<a href="#">@lang('main.menu_about')</a>
								<ul class="submenu">
									<li><a href="{{ route('compro.reandaInternational') }}">@lang('main.menu_about_1')</a> </li>
									<li><a href="{{ route('compro.AboutUs') }}">@lang('main.menu_about_3')</a></li>
									<li><a href="{{ route('compro.TL') }}">@lang('main.menu_about_5')</a></li>
									<!-- <li><a href="#">Banking Partners & Regulators</a> </li> -->
								</ul>
							</li>
						</ul>
						<ul class="root-menu">
							<li>
								<a href="#">@lang('main.menu_service')</a>
								<ul class="submenu">
									<li><a href="{{ route('compro.servAuditAss') }}">@lang('main.serveaccount_list1')</a></li>
									<li><a href="{{ route('compro.servTax') }}">@lang('main.serveaccount_list2') </a></li>
									<li><a href="{{ route('compro.servConsul') }}">@lang('main.serveaccount_list3') </a> </li>
									<li><a href="{{ route('compro.servCapital') }}">@lang('main.serveaccount_list4')</a></li>
									<li><a href="{{ route('compro.servMA') }}">@lang('main.serveaccount_list11') </a> </li>
									<li><a href="{{ route('compro.servAccount') }}">@lang('main.serveaccount_list5')</a></li>
									<li><a href="{{ route('compro.servTecho') }}">@lang('main.serveaccount_list6')</a></li>
									<li><a href="{{ route('compro.servFraud') }}">@lang('main.serveaccount_list7')</a></li>
									<li><a href="{{ route('compro.servEntrep') }}">@lang('main.serveaccount_list8')</a></li>
									<li><a href="{{ route('compro.servChina') }}">@lang('main.serveaccount_list9')</a></li>
									<li><a href="{{ route('compro.servJapan') }}">@lang('main.serveaccount_list10')</a></li>
								</ul>
							</li>
						</ul>
						<ul class="root-menu">
							<li>
								<a href="#">@lang('main.menu_industry')</a>
								<ul class="submenu">
									<li><a href="{{ route('compro.indusCons') }}">@lang('main.menu_industry_1')</a></li>
									<li><a href="{{ route('compro.indusEnergy') }}">@lang('main.menu_industry_2')</a></li>
									<li><a href="{{ route('compro.indusFinan') }}">@lang('main.menu_industry_3')</a> </li>
									<li><a href="{{ route('compro.indusGov') }}">@lang('main.menu_industry_4')</a> </li>
								</ul>
							</li>
						</ul>
						<ul class="root-menu">
							<li>
								<a href="#">@lang('main.menu_newsroom')</a>
								<ul class="submenu">
									<li><a href="{{ route('compro.mediaCenter') }}">@lang('main.menu_newsroom_1')</a></li>
									<li class="submenu-right-hover">
										<a href="{{ route('compro.publications') }}">@lang('main.menu_newsroom_2')
											<span class="arrow fa fa-chevron-right"></span>
										</a>
										<ul class="submenu-right">
											<li><a href="{{ route('compro.pubTax') }}">@lang('main.menu_newsroom_3')</a></li>
											<li><a href="{{ route('compro.pubPrim') }}">@lang('main.menu_newsroom_4')</a></li>
											<li><a href="{{ route('compro.pubAn') }}">@lang('main.menu_newsroom_5')</a></li>
											<li><a href="{{ route('compro.pubCon') }}">@lang('main.menu_newsroom_6')</a></li>
											<li><a href="{{ route('compro.pubDB') }}">@lang('main.menu_newsroom_7')</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<ul  class="root-menu">
							<li>
								<a href="{{ route('compro.career') }}">@lang('main.menu_career')</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>

<br>
<br>
<br>
<br>
<br>
<br>
    <p class="enclose problem">
        <a href="https://wa.me/628111999916"><img style="height: 100px" style="width: 100px"  src="{{asset('assets/compro/assets/frontend_assets/images/WA.png')}}" alt="WA"></a>
    </p>
    @yield('content')
    <footer>
  		<div class="container">
  			<div class="row">
  				<div class="col-sm-4">
  					<h6>@lang('main.footer_get_connected')</h6>
  					<ul>
  						<li><a href="{{ route('compro.AboutUs') }}">@lang('main.footer_about_us')</a></li>
  						<li><a href="{{ route('compro.contact') }}">@lang('main.footer_contact_us')</a></li>
  					</ul>
  				</div>
  				<div class="col-sm-4">
  					<h6>@lang('main.footer_career')</h6>
  					<ul>
  						<li><a href="{{ route('compro.career') }}">@lang('main.footer_join_us')</a></li>
  					</ul>
  				</div>
  				<div class="col-sm-4">
  					<h6>@lang('main.footer_newsroom')</h6>
  					<ul>
  						<li><a href="{{ route('compro.mediaCenter') }}">@lang('main.footer_media_center')</a></li>
  						<li><a href="{{ route('compro.publications') }}">@lang('main.footer_publication')</a></li>
  					</ul>
  				</div>
  			</div>
  		</div>
  	</footer>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
		integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>

	<script type="text/javascript">


		$(document).ready(function () {

			$('.show-menu').click(function(){
				$('header.menu-mobile').addClass('showed-menu');
				$('div.shadow').addClass('showed-shadow');
			})
			$('.hide-menu').click(function(){
				$('header.menu-mobile').removeClass('showed-menu');
				$('div.shadow').removeClass('showed-shadow');
			});


			$('.arrow-top-about').click(function(){
				if ( $('li.m-parents-about').children('ul').hasClass("showed") ) {
					$('li.m-parents-about').children('ul').removeClass('showed');
				}else{
					$('li.m-parents-about').children('ul').addClass('showed');
				}
				if ( $('.arrow-top-about').hasClass("turned") ) {
					$('.arrow-top-about').removeClass('turned');
				}else{
					$('.arrow-top-about').addClass('turned');
				}
			})

			$('.arrow-top-service').click(function(){
				if ( $('li.m-parents-service').children('ul').hasClass("showed") ) {
					$('li.m-parents-service').children('ul').removeClass('showed');
				}else{
					$('li.m-parents-service').children('ul').addClass('showed');
				}
				if ( $('.arrow-top-service').hasClass("turned") ) {
					$('.arrow-top-service').removeClass('turned');
				}else{
					$('.arrow-top-service').addClass('turned');
				}
			})

			$('.arrow-top-indus').click(function(){
				if ( $('li.m-parents-indus').children('ul').hasClass("showed") ) {
					$('li.m-parents-indus').children('ul').removeClass('showed');
				}else{
					$('li.m-parents-indus').children('ul').addClass('showed');
				}
				if ( $('.arrow-top-indus').hasClass("turned") ) {
					$('.arrow-top-indus').removeClass('turned');
				}else{
					$('.arrow-top-indus').addClass('turned');
				}
			})

			$('.arrow-top-news').click(function(){
				if ( $('li.m-parents-news').children('ul').hasClass("showed") ) {
					$('li.m-parents-news').children('ul').removeClass('showed');
				}else{
					$('li.m-parents-news').children('ul').addClass('showed');
				}
				if ( $('.arrow-top-news').hasClass("turned") ) {
					$('.arrow-top-news').removeClass('turned');
				}else{
					$('.arrow-top-news').addClass('turned');
				}
			})

			$('.arrow-top-pub').click(function(){
				if ( $('ul.m-parents-pub').hasClass("showed") ) {
					$('ul.m-parents-pub').removeClass('showed');
				}else{
					$('ul.m-parents-pub').addClass('showed');
				}
				if ( $('.arrow-top-pub').hasClass("turned") ) {
					$('.arrow-top-pub').removeClass('turned');
				}else{
					$('.arrow-top-pub').addClass('turned');
				}
			})
		});
	</script>

	@stack('scripts')
</body>

</html>
