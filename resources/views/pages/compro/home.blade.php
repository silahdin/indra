@extends('layouts.appcompro')

@section('content')


<?php
	$sliders = DB::table('new_cms_landing_sliders')->get();
?>

	@if($sliders->where('status', 1)->count() == 0)
		<div class="space-top"></div>
	@else
		<br>
		<br>
		<br>
		<br>
	@endif

	
	

	<div class="slideshow-container">

		@foreach($sliders as $slider)

			@if($slider->status == 1)

				<div class="mySlides fadeBro">
				  <img src="{{ asset(@$slider->image_url) }}" style="width:100%; max-height: 520px;">
				  <div class="text_content">
					  <div class="text">{{ @$slider->title }}</div>
					  <div class="text2">{{ @$slider->sub_title }}</div>
					  <div class="text_content_detail">
					  	<div class="text3">
						  	{!! @$slider->brief !!}
						  </div>
						  
					  </div>
					  <div class="text4">
					  	<a {{ (@$slider->link_open == 1) ? 'target=_blank' : '' }} href="{{ @$slider->link_url }}">{{ @$slider->link_text }}</a>
					  </div>
				  </div>
				</div>

			@endif

		@endforeach

		@if($sliders->where('status', 1)->count() > 1)

			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>

		@endif

	</div>
	<br>
	<br>


	<div class="section-three">
		<div class="container container-content">

			<div class="row margin-right-0">
				<div class="col-sm-12 col-text-program">
					<h2>@lang('main.main_service')</h2>
					<h6>@lang('main.service_detail')</h6>
				</div>
				<div class="col-sm-3 col-box-program">
					<div class="box-program">
						<div class="row">
							<div class="col-sm-3">
								<a href="https://reandabernardi.com/services/list/2">
									<img onmouseover="hover1(this);" onmouseout="unhover1(this);" src="{{asset('assets/compro/assets/frontend_assets/images/program/basic1.png')}}" alt="">
								</a>
							</div>
							<div class="col-sm-8">
								<h4>@lang('main.service_audit')</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p>
									{{str_limit(Lang::get('main.service_audit_detail'), 210)}}
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<a href="https://reandabernardi.com/services/list/2">@lang('main.more')</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-3 col-box-program">
					<div class="box-program">
						<div class="row">
							<div class="col-sm-3">
								<a href="https://reandabernardi.com/services/list/3"><img onmouseover="hover2(this);" onmouseout="unhover2(this);"
										src="{{asset('assets/compro/assets/frontend_assets/images/program/designer1.png')}}" alt=""></a>
							</div>
							<div class="col-sm-8">
								<h4>@lang('main.service_tax') </h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p>
										{{str_limit(Lang::get('main.service_tax_detail'), 210)}}
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<a href="https://reandabernardi.com/services/list/3">@lang('main.more')</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-box-program">
					<div class="box-program">
						<div class="row">
							<div class="col-sm-3">
								<a href="https://reandabernardi.com/services/list/10"><img onmouseover="hover3(this);" onmouseout="unhover3(this);"
										src="{{asset('assets/compro/assets/frontend_assets/images/program/group1.png')}}" alt=""></a>
							</div>
							<div class="col-sm-8">
								<h4>M&A</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p>
										{{str_limit(Lang::get('main.service_ma_detail'), 210)}}
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<a href="https://reandabernardi.com/services/list/10">@lang('main.more')</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-box-program">
					<div class="box-program">
						<div class="row">
							<div class="col-sm-3">
								<a href="https://reandabernardi.com/services/list/7"><img onmouseover="hover4(this);" onmouseout="unhover4(this);"
										src="{{asset('assets/compro/assets/frontend_assets/images/program/wira1.png')}}" alt=""></a>
							</div>
							<div class="col-sm-8">
								<h4>@lang('main.service_advisory')</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<p>
									{{str_limit(Lang::get('main.service_advisory_detail'), 210)}}
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<a href="https://reandabernardi.com/services/list/7">@lang('main.more')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<section class="three">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">

					<?php
						$cekImage = DB::table('new_cms_landing_images')->first();

						$landingImage = asset('assets/compro/assets/frontend_assets/images/landing_image/default.jpg');

						if($cekImage){
							$landingImage = asset($cekImage->image_url);
						}
					?>

					<img src="{{ $landingImage }}"
						alt="" width="100%">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="contain-text-three">
						<h3>@lang('main.empower_best')</h3>
						<hr>
						<p>@lang('main.empower_detail')</p>
						<br>
						<a href="{{ route('compro.career') }}">Join Us</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-text-program">
				<h2>@lang('main.trust_by')</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<section class="regular slider">
				<?php foreach ($partner as $key) { ?>
					<div>
						<div>
							<span>
								<img src="{{asset($key->logo)}}" width="110">
							</span>
						</div>
					</div>
				<?php }?>
				</section>
			</div>
		</div>
	</div>
	<br>
	<br>
    @include('pages.compro.follow')
@endsection

@push('styles')
	<style>
		* {box-sizing: border-box}
		.mySlides {display: none}
		img {vertical-align: middle;}

		/* Slideshow container */
		.slideshow-container {
		  /*max-width: 1000px;*/
		  position: relative;
		  margin: auto;
		}

		/* Next & previous buttons */
		.prev, .next {
		  cursor: pointer;
		  position: absolute;
		  top: 50%;
		  width: auto;
		  padding: 16px;
		  margin-top: -22px;
		  color: white !important;
		  font-weight: bold;
		  font-size: 18px;
		  /*transition: 0.6s ease;*/
		  border-radius: 0 3px 3px 0;
		  user-select: none;
		  background-color: rgba(0,0,0,0.5);
		}

		/* Position the "next button" to the right */
		.next {
		  right: 0;
		  border-radius: 3px 0 0 3px;
		}

		/* On hover, add a black background color with a little bit see-through */
		.prev:hover, .next:hover {
		  background-color: rgba(0,0,0,0.8);
		}

		.text_content{
		  text-align: left;
		  background-color: rgba(0,0,0,0.6);
		  border: solid 1px rgba(0,0,0,0.6);
		  border-radius: 5px;
		  padding-top: 15px;
		  padding-bottom: 25px;
		  padding-left: 40px;
		  padding-right: 40px;
		  position: absolute;
		  top: 20%;
		  left: 8%;
		  max-width: 50%;
		}

		/* Caption text */
		.text {
		  	font-size: 2.4rem;
		    font-weight: 600;
		    color: #0cb9b5;
		    text-shadow: 2px 2px #314c67;
		    max-height: 600px;
		}

		.text2 {
			color: #fff;
		  	font-size: 1.5rem;
		  	margin-top: -5px;
		  	margin-bottom: 10px;
		}

		/* Caption text */
		.text3 {
		  color: #0cb9b5;
		  font-size: 1.2rem;
		}

		/* Caption text */
		.text4 a {
		  color: #fff;
		  font-size: 1.2rem;
		  text-decoration: underline;
		}

		.text_content_detail{
			max-height: 150px;
			overflow-y: scroll;
		}

		/* Hide scrollbar for Chrome, Safari and Opera */
		.text_content_detail::-webkit-scrollbar{
			display: none;
		}

		/* Hide scrollbar for IE, Edge and Firefox */
		.text_content_detail {
		  -ms-overflow-style: none;  /* IE and Edge */
		  scrollbar-width: none;  /* Firefox */
		}

		.text4{
			margin-top: 10px;
		}

		/* Number text (1/3 etc) */
		.numbertext {
		  color: #f2f2f2;
		  font-size: 12px;
		  padding: 8px 12px;
		  position: absolute;
		  top: 0;
		}

		/* The dots/bullets/indicators */
		.dot {
		  cursor: pointer;
		  height: 15px;
		  width: 15px;
		  margin: 0 2px;
		  background-color: #bbb;
		  border-radius: 50%;
		  display: inline-block;
		  transition: background-color 0.6s ease;
		}

		.active, .dot:hover {
		  background-color: #717171;
		}

		/* Fading animation */
		.fadeBro {
		  -webkit-animation-name: fade !important;
		  -webkit-animation-duration: 1.5s !important;
		  animation-name: fade !important;
		  animation-duration: 1.5s !important;
		}

		@-webkit-keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		@keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		/* On smaller screens, decrease text size */
		@media only screen and (max-width: 1900px) {
		  .text_content {top: 27%; left: 5%;}
		}

		@media only screen and (max-width: 1600px) {
		  .text_content {top: 25%; left: 5%;}
		}

		@media only screen and (max-width: 1300px) {
		  .text_content {top: 25%; left: 6%;}
		}

		@media only screen and (max-width: 1024px) {
		  .text_content {top: 24%; left: 9%; max-width: 80%;}
		}

		@media only screen and (max-width: 900px) {
		  .text_content {top: 28%; left: 8%; max-width: 80%}
		}

		@media only screen and (max-width: 800px) {
		  .text_content {top: 10%; left: 8%; max-width: 80%}
		}

		@media only screen and (max-width: 768px) {
			.prev, .next,.text {font-size: 11px}
		  	.text_content {top: 14%; left: 9%; max-width: 80%}
		  	.text{font-size: 2rem}
		  	.text2{font-size: 1.2rem}
		  	.text3, .text4 a {font-size: 1rem}
		  	.text_content_detail{ max-height: 150px; }
		}

		@media only screen and (max-width: 600px) {
			.prev, .next,.text {font-size: 11px}
		  	.text_content {top: 10%; left: 8%; max-width: 80%}
		  	.text{font-size: 2rem}
		  	.text2{font-size: 1.2rem}
		  	.text3, .text4 a {font-size: 1rem}
		  	.text_content_detail{ max-height: 120px; }
		}

		@media only screen and (max-width: 540px) {
			.prev, .next {font-size: 11px}
		  	.text_content {top: 12%; left: 9%; max-width: 80%}
		  	.text{font-size: 1.8rem}
		  	.text2{font-size: 1.1rem}
		  	.text3, .text4 a {font-size: 1rem}
		  	.text_content_detail{ max-height: 90px; }
		}

		@media only screen and (max-width: 490px) {
			.prev, .next {font-size: 11px; padding: 10px;}
		  	.text_content {top: 12%; left: 10%; max-width: 80% padding-top: 5px; padding-bottom: 10px;}
		  	.text{font-size: 1.2rem}
		  	.text2{font-size: 0.8rem}
		  	.text3, .text4 a {font-size: 0.9rem}
		  	.text_content_detail{ max-height: 80px; }
		}

		@media only screen and (max-width: 380px) {
			.prev, .next {font-size: 11px; padding: 8px;}
		  	.text_content {top: 14%; left: 10%; max-width: 80%; padding-top: 5px; padding-bottom: 10px; padding-right: 8px; padding-left: 18px;}
		  	.text{font-size: 1.1rem}
		  	.text2{font-size: 0.7rem}
		  	.text3, .text4 a {font-size: 0.8rem}
		  	.text_content_detail{ max-height: 45px; }
		}

		@media only screen and (max-width: 300px) {
			.prev, .next {font-size: 11px; padding: 8px;}
		  	.text_content {top: 14%; left: 10%; max-width: 80%; padding-top: 5px; padding-bottom: 5px; padding-right: 8px; padding-left: 18px;}
		  	.text{font-size: 1rem}
		  	.text2{font-size: 0.7rem}
		  	.text3, .text4 a {font-size: 0.7rem}
		  	.text_content_detail{ max-height: 40px; }
		}
	</style>
@endpush

@push('scripts')
<script>
	var slideIndex = 1;
	showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  // var dots = document.getElementsByClassName("dot");
	  if (n > slides.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
	      slides[i].style.display = "none";
	  }
	  // for (i = 0; i < dots.length; i++) {
	  //     dots[i].className = dots[i].className.replace(" active", "");
	  // }
	  slides[slideIndex-1].style.display = "block";
	  // dots[slideIndex-1].className += " active";
	}
</script>
@endpush
