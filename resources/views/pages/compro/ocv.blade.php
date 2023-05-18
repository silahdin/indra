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
            <?php
            $setocv = DB::table('cms_setting')
            ->select('ocv')
            ->where('id', 1)
            ->first();
            ?>
			<h1>@lang('main.core_value')</h1>
		</div>
	</section>

	<br>
	<br>
	<br>
	<section class="person-leader">
		<div class="container container-custom">
			<div class="row">
                <div class="col-sm-12">
                        <!--{!!$setocv->ocv!!}-->
                        @lang('main.core_detail')
                </div>
			</div>
		</div>
	</section>

	<br>
	<br>
	<br>

@endsection
