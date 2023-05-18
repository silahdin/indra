@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/international.jpg');
?>
<div class="space-top">
</div>

<section class="services-page person-leader detail-leader">
    <div class="container">
		<div class="row">
			<div class="col-sm-2 pad-5 sub-flex-2">
				<div class="pub-wrap">
					<h4 class="text-center">@lang('main.publication_link1')
						</h4>
					<img src="{{asset('assets/compro/assets/frontend_assets/images/publication/Tax Year Book.png')}}" alt="">
					<!--<div>-->
					<!--	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, enim?</p>-->
					<!--</div>-->
					<a href="{{ route('compro.pubTax') }}">@lang('main.media_read_more')</a>
				</div>
			</div>
			<div class="col-sm-2 pad-5 sub-flex-2">
				<div class="pub-wrap">
					<h4 class="text-center">@lang('main.publication_link2')
						</h4>
					<img src="{{asset('assets/compro/assets/frontend_assets/images/publication/PRISM Newletter.png')}}" alt="">
					<!--<div>-->
					<!--	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, enim?</p>-->
					<!--</div>-->
					<a href="{{ route('compro.pubPrim') }}">@lang('main.media_read_more')</a>
				</div>
			</div>
			<div class="col-sm-2 pad-5 sub-flex-2">
				<div class="pub-wrap">
					<h4 class="text-center">@lang('main.publication_link3')
						</h4>
					<img src="{{asset('assets/compro/assets/frontend_assets/images/publication/Annual Review.png')}}" alt="">
					<!--<div>-->
					<!--	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, enim?</p>-->
					<!--</div>-->
					<a href="{{ route('compro.pubAn') }}">@lang('main.media_read_more')</a>
				</div>
			</div>
			<div class="col-sm-2 pad-5 sub-flex-2">
				<div class="pub-wrap">
					<h4 class="text-center">@lang('main.publication_link4')
						</h4>
					<img src="{{asset('assets/compro/assets/frontend_assets/images/publication/Country Report.png')}}" alt="">
					<!--<div>-->
					<!--	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, enim?</p>-->
					<!--</div>-->
					<a href="{{ route('compro.pubCon') }}">@lang('main.media_read_more')</a>
				</div>
			</div>
			<div class="col-sm-2 pad-5 sub-flex-2">
				<div class="pub-wrap">
					<h4 class="text-center">@lang('main.publication_link5')
						</h4>
					<img src="{{asset('assets/compro/assets/frontend_assets/images/publication/Doing Business Guide.png')}}" alt="">
					<!--<div>-->
					<!--	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, enim?</p>-->
					<!--</div>-->
					<a href="{{ route('compro.pubDB') }}">@lang('main.media_read_more')</a>
				</div>
			</div>
		</div>
    </div>
</section>


	<br>
	<br>
    @include('pages.compro.follow')


@endsection
