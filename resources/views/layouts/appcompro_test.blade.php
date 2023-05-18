<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php if (isset($title)){ ?>
    @if ( Session::get('langIN') != NULL )
    <?php if (isset($title_sub)){ ?>
    <title>{{ $setting->title_in }} | {{ @$title->title_in ?? @$title['title_in'] }} - {{ @$post->title_in ?? @$title['title_in'] }} </title>
    <?php }else{ ?>
    <title>{{ $setting->title_in }} | {{ @$title->title_in ?? @$title['title_in'] }} </title>
    <?php } ?>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
    <?php if (isset($title_sub)){ ?>
    <title>{{ $setting->title_en }} | {{ @$title->title_en ?? @$title['title_en'] }} - {{ @$post->title_en ?? @$post['title_en'] }} </title>
    <?php }else{ ?>
    <title>{{ @$setting->title_en }} | {{ @$title->title_en ?? @$title['title_en'] }} </title>
    <?php } ?>
    @endif

    <?php }else { ?>
    @if ( Session::get('langIN') != NULL )
    <title>{{ $setting->title_in }} | Beranda</title>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
    <title>{{ $setting->title_en }} | Home</title>
    @endif
    <?php } ?>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- OLD META
	    <meta name="keyword" content="{{ $setting->keywords }}">
	    <meta property="og:site_name" content="http://{{$setting->sitename}}" />
	    <meta property="og:title" content="{{ $setting->title_en }}" />
	    <meta property="og:description" content="{{ $setting->description }}" />
	-->

	<meta name="site_name" content="{{ (Session::get('langIN') != NULL) ? $setting->site_name_in : $setting->site_name_en }}">
	<meta name="title" content="{{ (Session::get('langIN') != NULL) ? $setting->meta_title_in : $setting->meta_title_en }}">
	<meta name="description" content="{{ (Session::get('langIN') != NULL) ? $setting->meta_description_in : $setting->meta_description_en }}">
	<meta name="keyword" content="{{ (Session::get('langIN') != NULL) ? $setting->meta_keyword_in : $setting->meta_keyword_en }}">


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
    <script src="{{ asset('assets/compro/assets/frontend_assets/js/jquery/jquery-3.3.1.min.js') }}"></script>

    <link rel="alternate" type="application/rss+xml" title="ror" href="https://reandabernardi.com/ror.xml" />
    <link rel="alternate" type="application/rss+xml" title="sitemap" href="https://reandabernardi.com/sitemap.xml" />

    <script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

	<link href="{{ asset('assets/lte/plugins/swal/swal.css') }}" rel="stylesheet">

	<script src="{{ asset('assets/lte/plugins/swal/swal.min.js') }}"></script>

</head>
<style>
.language .actived a{
    border-bottom: 1px solid #fff;
    text-decoration: none;
}
</style>
	
@stack('styles')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119897347-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-119897347-1');
</script>
	<script>
			(function() {
				var cx = '016051235887093224685:5jhqxribafs';
				var gcse = document.createElement('script');
				gcse.type = 'text/javascript';
				gcse.async = true;
				gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(gcse, s);
			})();
			</script>
<body>

	<header class="head-mobile">
		<nav class="top">
			<div class="flex-box wrap">
				@if(Auth::check())
					Logout
				@else
					<a href="{{ env('APP_URL_LOGIN') }}">@lang('main.services_list_login')</a>
				@endif
				
				<a href="{{ route('compro.contact') }}">@lang('main.services_list_contact')</a>
			</div>
		</nav>
		<nav class="bottom">
			<div class="flex-box wrap">
				<a href="{{ route('compro.home', ['lang' => App::getLocale()]) }}"><img src="{{asset('assets/compro/assets/frontend_assets/images/logo/ab.png')}}" alt="" ></a>
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
						<li><a href="{{ route('compro.charimanmessage') }}#profileLeader">@lang('main.menu_about_2')</a> </li>
						<li><a href="{{ route('compro.AboutUs') }}">@lang('main.menu_about_3') </a></li>
						<li><a href="{{ route('compro.ocv') }}">@lang('main.menu_about_4')</a></li>
						<li><a href="{{ route('compro.TL') }}">@lang('main.menu_about_5')</a></li>
					</ul>
					<span class="arrow arrow-top-about fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-service">
					<a href="#">@lang('main.menu_service')</a>
					<ul class="">
								@foreach ($servs as $serv)
									<li><a href="{{ route('compro.servListId',['id'=>$serv->service_id]) }}">{{$serv->name}}</a></li>
								@endforeach
						<!-- <li><a href="{{ route('compro.servAuditAss') }}">@lang('main.serveaccount_link1') </a></li>
						<li><a href="{{ route('compro.servTax') }}">@lang('main.serveaccount_link2') </a></li>
						<li><a href="{{ route('compro.servConsul') }}">@lang('main.serveaccount_link3') </a> </li>
						<li><a href="{{ route('compro.servCapital') }}">@lang('main.serveaccount_link4') </a></li>
						<li><a href="{{ route('compro.servMA') }}">Merge & Acquisitions </a> </li>
						<li><a href="{{ route('compro.servAccount') }}">@lang('main.serveaccount_link5') </a></li>
						<li><a href="{{ route('compro.servTecho') }}">@lang('main.serveaccount_link6') </a></li>
						<li><a href="{{ route('compro.servFraud') }}">@lang('main.serveaccount_link7') </a></li>
						<li><a href="{{ route('compro.servEntrep') }}">@lang('main.serveaccount_link8') </a></li>
						<li><a href="{{ route('compro.servChina') }}">@lang('main.serveaccount_link9') </a></li>
						<li><a href="{{ route('compro.servJapan') }}">@lang('main.serveaccount_link10') </a></li> -->
					</ul>
					<span class="arrow arrow-top-service fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-indus">
					<a href="#">@lang('main.menu_industry')</a>
					<ul class="">
						<li><a href="{{ route('compro.indusCons') }}">@lang('main.menu_industry_1')</a></li>
						<li><a href="{{ route('compro.indusEnergy') }}">@lang('main.menu_industry_2')</a></li>
						<li><a href="{{ route('compro.indusFinan') }}">@lang('main.menu_industry_3')</a> </li>
						<!--<li><a href="{{ route('compro.indusTel') }}">Telecommunications, Media and Technology</a></li>-->
						<li><a href="{{ route('compro.indusGov') }}">@lang('main.menu_industry_4')</a> </li>
					</ul>
					<span class="arrow arrow-top-indus fa fa-chevron-down"></span>
				</li>
				<li class="m-parents-news">
					<a href="#">@lang('main.menu_newsroom')</a>
					<ul class="">
						<li><a href="{{ route('compro.mediaCenter') }}">@lang('main.menu_newsroom_1')  </a></li>
						<li class="">
							<a href="{{ route('compro.publications') }}">@lang('main.menu_newsroom_2')</a>
							<ul class="m-parents-pub">
								<li><a href="{{ route('compro.pubTax') }}">@lang('main.menu_newsroom_3') </a></li>
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
          <div class="" style="margin: 6px auto; text-align: center;">
            <select class="sel-lang" style="width: 90%; background-color: DodgerBlue; color: white; border-color: DodgerBlue; text-align: center;">
              <option value="en">English</option>
              <option value="ch">中 文</option>
            </select>
          </div>
						<gcse:search></gcse:search>
						<?php /*<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">*/ ?>
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
                            @if(Auth::check())
                            	<a href="{{ route('home') }}">Home</a>
                            	<a class="space-a"> | </a>
                            @endif

                            @if(Auth::check())
								<a href="{{ route('logout') }}"
				                      onclick="event.preventDefault();
				                                    document.getElementById('logout-form').submit();">
			                      	{{ __('Logout') }}
			                  	</a>

			                  	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                      	@csrf
			                  	</form>
							@else
								<a href="{{ env('APP_URL_LOGIN') }}">@lang('main.services_list_login')</a>
							@endif

                            @if(!Auth::check())
	                            <a class="space-a"> | </a>
	                            <a href="{{ route('compro.contact') }}">@lang('main.services_list_contact')</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top btm-nav" style="padding-bottom: 20px;">
			<div class="container">
				<div class="top-menus">
					<div class="flex-box">
						<div class="box">
							<a class="navbar-brand" href="{{ route('compro.home', ['lang' => App::getLocale()]) }}">
								<img src="{{asset('assets/compro/assets/frontend_assets/images/logo/ab.png')}}" alt="" width="400">
								<div class="logo-text">
									<!-- <span>What is this</span>
									<span>What is this</span> -->
								</div>
							</a>
						</div>

						<div class="form-inline ">

								
						</div>
					</div>
				</div>
			</div>
			
		
            {{-- @if(!Auth::check() || (Auth::check() && !request()->is('home'))) --}}
				
			{{-- @endif --}}
		</nav>
	</header>

    @yield('content')

    <br>
    <br>
    @include('pages.compro.follow')

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/compro/assets/frontend_assets/js/animatedModal.min.js') }}"></script>

	<script type="text/javascript">



		function hover1(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/basic2.png');
		}
		function unhover1(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/basic1.png');
		}

		function hover2(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/designer2.png');
		}

		function unhover2(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/designer1.png');
		}


		function hover3(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/group2.png');
		}

		function unhover3(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/group1.png');
		}



		function hover4(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/wira2.png');
		}

		function unhover4(element) {
			element.setAttribute('src', 'assets/compro/assets/frontend_assets/images/program/wira1.png');
		}

        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 2,
            responsive: [{
                breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                }
            ]
        });



        $(".center-mode").slick({
			centerMode: true,
			centerPadding: '60px',
			slidesToShow: 3,
			responsive: [
				{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 3
					}
				},
				{
				breakpoint: 480,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
					}
				}
			]
        });

		$(document).ready(function () {

      $(".sel-lang").val("{{ session('language') }}");

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

      $('.sel-lang').change(function(e) {
        $.ajax({
          url: "{{route('compro.setlang')}}",
          method: 'GET',
          data: {'lang': e.target.value, '_token': "{{ csrf_token() }}"}
        }).done(function(data) {
          //console.log(data);
          location.reload();
        });
      });
		});
	</script>

	@stack('scripts')

</body>

</html>
