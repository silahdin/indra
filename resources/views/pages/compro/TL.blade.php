@extends('layouts.appcompro')

@section('content')


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/wall.jpg');
$imgBannerSmall = asset('assets/compro/assets/frontend_assets/images/slider/wall-small.jpg');

?>
<style>
.img-banner{
	background:url('{{$imgBanner}}');
	background-size: cover;
	height: 500px;
	background-position: center;
}

@media only screen and (max-width: 820px) {
.img-banner{
	background:url('{{$imgBannerSmall}}');
	background-size: cover;
	height: 500px;
	background-position: center;
}

}
</style>
<div class="space-top">
	</div>

	<section class="img-banner about flex-box"
		style="">
		<div class="boxes">
			<h1>@lang('main.tl_leader')</h1>
			<p>@lang('main.tl_leader_detail')
			</p>
		</div>
	</section>

	<br>
	<br>
	<br>
	<section class="person-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-9">
					<h2>@lang('main.tl_title1') </h2>
					<h5>@lang('main.tl_title1_detail')</h5>
					<?php /*<img class="img-tl-res" src="{{asset('assets/compro/assets/frontend_assets/images/about/ms_bernardi.png')}}" alt="">*/ ?>
					<p>@lang('main.tl_title1_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'Michelle' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="mailto:michelle.bernardi@reandabernardi.com" class="fa fa-envelope"></a>
						<a href="https://www.linkedin.com/in/michelle-bernardi-cpa-mba-b13138b/" class="fa fa-linkedin"></a>
					</div>
				</div>
				<div class="col-sm-3">
					<img class="img-tl" src="{{asset('assets/compro/assets/frontend_assets/images/about/ms_bernardi.png')}}" alt="">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset('assets/compro/assets/frontend_assets/images/about/David.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>@lang('main.tl_title2')</h2>
					<h5>@lang('main.tl_title2_detail')</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/David.png')}}" alt="">*/ ?>

					<p>@lang('main.tl_title2_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'David' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="" class="fa fa-envelope"></a>
						<a href="https://www.linkedin.com/in/david-batara-pardede-12b1a450/" class="fa fa-linkedin"></a>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-9">
					<h2>@lang('main.tl_title3') </h2>
					<h5>@lang('main.tl_title3_detail')</h5>
					<?php /*<img class="img-tl-res" src="{{asset('assets/compro/assets/frontend_assets/images/about/heru.png')}}" alt="">*/ ?>

					<p>@lang('main.tl_title3_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'Heru' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="mailto:heru.prasetyo@reandabernardi.com" class="fa fa-envelope"></a>
						<a href="https://www.linkedin.com/in/heru-tio-prasetyo-aaa968/" class="fa fa-linkedin"></a>
					</div>
					<br>
					<br>
				</div>
				<div class="col-sm-3">
					<img class="img-tl" src="{{asset('assets/compro/assets/frontend_assets/images/about/heru.png')}}" alt="">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Aditiya.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>@lang('main.tl_title4') </h2>
					<h5>@lang('main.tl_title4_detail')</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Aditiya.png')}}" alt="">*/ ?>
					<p>@lang('main.tl_title4_des') </p>
					<a href="{{ route('compro.TLOne', ['url' => 'Aditiya' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="mailto:aditiya.febriansyah@reandabernardi.com" class="fa fa-envelope"></a>
						<a href="https://www.linkedin.com/in/aditiya-febriansyah-55409728/" class="fa fa-linkedin"></a>
					</div>
					<br>
					<br>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-9">
					<h2>@lang('main.tl_title5')</h2>
					<h5>@lang('main.tl_title5_detail')</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/bodhiyanto.png')}}" alt="">*/ ?>
					<p>@lang('main.tl_title5_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'Bodhiyanto' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="" class="fa fa-envelope"></a>
						<a href="" class="fa fa-linkedin"></a>
					</div>
				</div>
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset('assets/compro/assets/frontend_assets/images/about/bodhiyanto.png')}}" alt="">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset('assets/compro/assets/frontend_assets/images/about/MarkBernardi.jpg')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>@lang('main.tl_title6')</h2>
					<h5>@lang('main.tl_title6_detail')</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Daniel.png')}}" alt="">*/ ?>
					<p>@lang('main.tl_title6_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'Mark' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="" class="fa fa-envelope"></a>
						<a href="" class="fa fa-linkedin"></a>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-sm-9">
					<h2>@lang('main.tl_title7')</h2>
					<h5>@lang('main.tl_title7_detail')</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Michiyo.png')}}" alt="">*/ ?>

					<p>@lang('main.tl_title7_des')</p>
					<a href="{{ route('compro.TLOne', ['url' => 'Michiyo' ] ) }}#profileLeader" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="" class="fa fa-envelope"></a>
						<a href="https://www.linkedin.com/in/michiyo-okubo-3724b0164/" class="fa fa-linkedin"></a>
					</div>
					<br>
					<br>
				</div>
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Michiyo.png')}}" alt="">
				</div>
			</div>
		</div>
	</section>

	<br>
	<br>
	<br>

@endsection
