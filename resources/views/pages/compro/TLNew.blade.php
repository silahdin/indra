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

        @foreach($leaders as $leader)
        <?php if ($leader->urutan%2 == 1){ ?>
			<div class="row">
				<div class="col-sm-9">
				
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->nama;
                      }
                     else
                      {
                       echo $leader->nama_ch;
                      }
                            			    
                      ?>
					
					</h2>
					<h5>
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->jabatan;
                      }
                     else
                      {
                       echo $leader->jabatan_ch;
                      }
                            			    
                      ?>
					
					</h5>
					<?php /*<img class="img-tl-res" src="{{asset('assets/compro/assets/frontend_assets/images/about/ms_bernardi.png')}}" alt="">*/ ?>
					<p>
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->summary_preview;
                      }
                     else
                      {
                       echo $leader->summary_preview_ch;
                      }
                            			    
                      ?>
					
					</p>
					<a href="{{ route('compro.TLOne', ['id' => $leader->leader_id ] ) }}" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
						<a href="<?php if($leader->email == "-"){echo '#';}else{ echo 'mailto:'.$leader->email;}?>" class="fa fa-envelope"></a>
						<a href="<?php if($leader->linkedin == "-"){echo '#';}else{ echo $leader->linkedin;}?>" class="fa fa-linkedin"></a>
					</div>
				</div>
				<div class="col-sm-3">
					<img class="img-tl" src="{{asset($leader->img)}}" alt="" height="200">
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>

        <?php }else if ($leader->urutan%2 == 0){ ?>
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl"  src="{{asset($leader->img)}}" alt="" height="200">
				</div>
				<div class="col-sm-9">
					<h2>
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->nama;
                      }
                     else
                      {
                       echo $leader->nama_ch;
                      }
                            			    
                      ?>
					</h2>
					<h5>
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->jabatan;
                      }
                     else
                      {
                       echo $leader->jabatan_ch;
                      }
                            			    
                      ?>
					</h5>
					<?php /*<img class="img-tl-res"  src="{{asset('assets/compro/assets/frontend_assets/images/about/David.png')}}" alt="">*/ ?>

					<p>
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->summary_preview;
                      }
                     else
                      {
                       echo $leader->summary_preview_ch;
                      }
                            			    
                      ?>
					</p>
					<a href="{{ route('compro.TLOne', ['id' => $leader->leader_id ] ) }}" class="btnc-more">@lang('main.media_read_more')</a>
					<div class="social-contact">
                        <a href="<?php if($leader->email == "-"){echo '#';}else{ echo 'mailto:'.$leader->email;}?>" class="fa fa-envelope"></a>
						<a href="<?php if($leader->linkedin == "-"){echo '#';}else{ echo $leader->linkedin;}?>" class="fa fa-linkedin"></a>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
        <?php }?>
        @endforeach
		</div>
	</section>

	<br>
	<br>
	<br>
    @include('pages.compro.follow')
@endsection
