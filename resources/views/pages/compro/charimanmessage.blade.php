@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/about.jpg');
?>
<?php 
$setocv = DB::table('cms_setting')
->select('images_cm', 'name_cm','name_ch', 'title_cm','title_ch', 'subtitle_cm','subtitle_ch', 'charimanmsg','charimanmsg_ch')
->where('id', 1)
->first();
$lang_org = session('language');

?>

<div class="space-top"></div>

	<br><br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl-res-dif"  src="{{$setocv->images_cm}}" alt="">
					<!-- <img src="./assets/compro/images/about/Aditiya.png" alt=""> -->
				</div>
				<div class="col-sm-9">
					<h2>
					    <?php
					if($lang_org=='en'){
					echo $setocv->subtitle_cm;
					    
					}
					else{
					    echo $setocv->subtitle_ch;
					}
				    ?>
					</h2>
					<h5 style="margin-bottom: 0px !important">
					    
					<?php
					if($lang_org=='en'){
					echo $setocv->title_cm;
					    
					}
					else{
					    echo $setocv->title_ch;
					}
				    ?>
					</h5>
					<span style="font-size: 12px"><?php
					if($lang_org=='en'){
					echo $setocv->subtitle_cm;
					    
					}
					else{
					    echo $setocv->subtitle_ch;
					}
				    ?></span>
					<br><br>
					<?php
					if($lang_org=='en'){
					echo $setocv->charimanmsg;
					    
					}
					else{
					    echo $setocv->charimanmsg_ch;
					}
				    ?>
					<br>
				</div>
			</div>
			<br>


		</div>
	</section>
	



	<br>
	<br>	
    @include('pages.compro.follow')
@endsection
