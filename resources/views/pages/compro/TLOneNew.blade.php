@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/about.jpg');
?>

<div class="space-top"></div>

	<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.tlone_leader')</h1>
			<p>@lang('main.tlone_leader_detail')</p>

			<p>@lang('main.tlone_leader_profile')
				<span style="position:hidden">
					<span id="profileLeader"></span>
				</span>
			</p>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl-res-dif"  src="{{asset($leader->img)}}" alt="">
					<!-- <img src="./assets/compro/images/about/Aditiya.png" alt=""> -->
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
				</div>
			</div>
			<br>


		</div>
	</section>

	<section class="person-leader-tab">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-12">
				   
					<input id="tab1" type="radio" name="tabs" checked>
					<label for="tab1">@lang('main.menuTLone_education')</label>

					<input id="tab2" type="radio" name="tabs">
					<label for="tab2">@lang('main.menuTLone_exp')</label>

					<input id="tab3" type="radio" name="tabs">
					<label for="tab3">@lang('main.menuTLone_indus')</label>

					<input id="tab4" type="radio" name="tabs">
					<label for="tab4">@lang('main.menuTLone_societies')</label>

					<section id="content1" class="single-content">

					<h6>@lang('main.menuTLone_education')</h6>
						
					<?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->edu_cert;
                      }
                     else
                      {
                       echo $leader->edu_cert_ch;
                      }
                            			    
                      ?>		

					</section>

					<section id="content2" class="single-content">
					<h6>@lang('main.menuTLone_exp')</h6>
              
              <?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->expertise;
                      }
                     else
                      {
                       echo $leader->expertise_ch;
                      }
                            			    
                      ?>

					</section>

					<section id="content3" class="single-content">
					<h6>@lang('main.menuTLone_indus')</h6>
                            
                    <?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->industries;
                      }
                     else
                      {
                       echo $leader->industries_ch;
                      }
                            			    
                      ?>
                            
					</section>

					<section id="content4" class="single-content">
					<h6>@lang('main.menuTLone_societies')</h6>
                            
                            <?php $lang_org = session('language');
                     if($lang_org=='en')
                     {
                      echo $leader->pro_societies;
                      }
                     else
                      {
                       echo $leader->pro_societies_ch;
                      }
                            			    
                      ?>
                            
					</section>
					<hr>

				</div>
			</div>
		</div>
	</section>

	<br>
	<br>
    @include('pages.compro.follow')

@endsection
