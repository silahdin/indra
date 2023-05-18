@extends('layouts.appcompro')

@section('content')


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/international.jpg');
?>
<style>
		.modal-lg {
			max-width: 50% !important;
	}
</style>
<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.newreanda_internation')</h1>
			<p>@lang('main.newreanda_internation_title')</p>
			<p>@lang('main.newreanda_internation_subtitle')</p>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-12">
					<h2>@lang('main.newreanda_firm_profile')</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<p>
						@lang('main.newreanda_title1')
					</p>
					<p>
						@lang('main.newreanda_title2')
					</p>
					<p>
						@lang('main.newreanda_title3')
					</p>
					<p>
						@lang('main.newreanda_title4')
					</p>
					<br>
					<br>
				</div>
				<div class="col-sm-3">
					<img class="img-dl-rl" src="{{asset('assets/compro/assets/frontend_assets/images/etc/dl.jpg')}}" alt="">
					<div class="wrapper-btn">
						<a href="{{asset('assets/compro/assets/frontend_assets/doc/etc/Reandabernardi-Compro-2018_FINAL.pdf')}}">@lang('main.newreanda_download_company')</a>
					</div>
				</div>
			</div>
			<br>

			<hr>

			<div class="row">
				<div class="col-12"><h2>@lang('main.newreanda_directory')</h2></div>
				<br><br><br>
				<div class="col-3">
				  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: white">
						<a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">AFRICA</a>
						<a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">ASIA</a>
						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">EUROPE</a>
						<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">MIDDLE EAST</a>
						<a class="nav-link" id="v-pills-test-tab" data-toggle="pill" href="#v-pills-test" role="tab" aria-controls="v-pills-settings" aria-selected="false">OCEANIA</a>
					</div>
				</div>
				<div class="col-9">
				  <div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
						<ul>

						<?php for($i=0;$i<count($files);$i++){?>
              <?php if($files[$i]->directory_id == 1){?>
								<li><a href="#" data-toggle="modal" data-target="<?php echo '#'.$country[$files[$i]->country_id-1]->country.'Modal';?>">{{ $country[$files[$i]->country_id-1]->country }}</a></li>
              <?php }} ?>
					</div>
					<div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<ul>

						<?php for($j=0;$j<count($files);$j++){?>
                <?php if($files[$j]->directory_id == 2){?>
									<li><a href="#" data-toggle="modal" data-target="<?php echo '#'.$country[$files[$j]->country_id-1]->country.'Modal';?>">{{ $country[$files[$j]->country_id-1]->country }}</a></li>
                <?php } } ?>
						</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<ul>

						<?php for($k=0;$k<count($files);$k++){?>
                <?php if($files[$k]->directory_id == 3){?>
							<li><a href="#" data-toggle="modal" data-target="<?php echo '#'.$country[$files[$k]->country_id-1]->country.'Modal';?>">{{ $country[$files[$k]->country_id-1]->country }}</a></li>
                <?php } } ?>
						</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<ul>
							<?php for($l=0;$l<count($files);$l++){?>
                <?php if($files[$l]->directory_id == 4){?>
							    <li><a href="#" data-toggle="modal" data-target="<?php echo '#'.$country[$files[$l]->country_id-1]->country.'Modal';?>">{{ $country[$files[$l]->country_id-1]->country }}</a></li>
                            <?php } } ?>
							</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">
						<ul>
						<?php for($m=0;$m<count($files);$m++){?>
                  <?php if($files[$m]->directory_id == 5){?>
                        <li><a href="#" data-toggle="modal" data-target="<?php echo '#'.$country[$files[$m]->country_id-1]->country.'Modal';?>">{{ $country[$files[$m]->country_id-1]->country }}</a></li>
                  <?php } } ?>
						</ul>
					</div>
				  </div>
				</div>
			  </div>


		</div>
	</section>


<br>
<br>

<!-- Afrika / Mauritius -->

<?php for($s=0;$s<count($files);$s++){?>
<div class="modal fade" id="<?php echo $country[$files[$s]->country_id-1]->country.'Modal';?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $country[$files[$s]->country_id-1]->country.'ModalLabel';?>" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="<?php echo $country[$files[$s]->country_id-1]->country.'ModalLabel';?>">{{ $country[$files[$s]->country_id-1]->country }}</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://<?php echo $files[$s]->website;?>/">{{ $files[$s]->website }}</a></h2></div>
							<div class="col-sm-12"><hr></div>

						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
				<div class="col-sm-6">
						<strong>{{ $files[$s]->cr_name1 }}</strong><br>
						{{ $files[$s]->cr_title1 }}<br>
						{{ $files[$s]->cr_email1 }}<br>
						Tel: {{ $files[$s]->cr_phone1 }}<br>
						Mobile: {{ $files[$s]->cr_mobile1 }}<br>
				</div>
				<div class="col-sm-6">
						<strong>{{ $files[$s]->lo_name1 }}</strong><br>
						{{ $files[$s]->lo_title1 }}<br>
						{{ $files[$s]->lo_email1 }}<br>
						Tel: {{ $files[$s]->lo_phone1 }}<br>
						Mobile: {{ $files[$s]->lo_mobile1 }}<br>
				</div>
				<div class="col-sm-12"><hr></div>
				<div class="col-sm-6">
						<strong>{{ $files[$s]->cr_name2 }}</strong><br>
						{{ $files[$s]->cr_title2 }}<br>
						{{ $files[$s]->cr_email2 }}<br>
						Tel: {{ $files[$s]->cr_phone2 }}<br>
						Mobile: {{ $files[$s]->cr_mobile2 }}<br>
				</div>
				<div class="col-sm-6">
						<strong>{{ $files[$s]->lo_name2 }}</strong><br>
						{{ $files[$s]->lo_title2 }}<br>
						{{ $files[$s]->lo_email2 }}<br>
						Tel: {{ $files[$s]->lo_phone2 }}<br>
						Mobile: {{ $files[$s]->lo_mobile2 }}<br>
				</div>
			  </div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>
<?php } ?>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
