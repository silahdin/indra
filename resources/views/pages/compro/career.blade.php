@extends('layouts.appcompro')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/free.jpg');
$allData = count($allProduk);
$showData = count($produk);
function convert_tgl_to_user($tgl){
    $tanggal =  substr($tgl, 0,10);
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
function convert_tgl_to_userEN($tgl){
    $tanggal =  substr($tgl, 0,10);
    $bulan = array (1 =>   'January',
                'February',
                'March',
                'April',
                'May',
                'Juny',
                'July',
                'Augustus',
                'September',
                'October',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>

<style>
.slick-initialized .slick-slide div {
    display: flex;
    width: 100%;
    height: 300px;
}
</style>
<script type="text/javascript" src="{{ asset('assets/compro/assets/frontend_assets/js/animatedModal.min.js') }}"></script>

<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/career.jpg');
?>
<div class="space-top">
</div>

<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px; background-position:center">
    <div class="boxes">
        <h1>@lang('main.career')</h1>
    </div>
</section>

<div class="section-content-career">
	<div class="container container-content">
		<!-- <div class="row">
			<div class="col-sm-12 col-btn-search">
				<form action="{{ route('compro.careerFinded') }}" method="POST">
					<div class="input-group date form_date col-md-12 art_tgl_berangkat area-date-input"
					data-link-field="dtp_input2" style="outline: none;">
					 {{  csrf_field() }}
						<input class="form-control" type="text" name="search" placeholder="Cari kerja"
						autocomplete="off">
						<input type="submit" class="btn btn-primary btn-search-career" value="Cari"/>
					</div>
				</form>
			</div>
		</div> -->
		<div class="row row-sort-career">
			<!-- <div class="col-sm-4">
				<span class="small-desk">1-{{$showData}} of {{$allData}} job matches</span>
			</div> -->
			<div class="col-sm-5 text-right">
			</div>
		</div>
		<div class="row row-min-12">
			<div class="col-sm-12">

        <h3>Discover your new career with us</h3>
        <br>

				<div class="row">
					<div class="col-sm-12">
						<section class="center-mode slider">
						<?php
						$no = 1;
						?>
						<?php foreach ($produk as $pos) { ?>
							<div class="item-center-slider">
							<?php
							$img = $pos->img;
							?>
								<div class="wrap-career flex-box" style="background: url('{{ asset($img) }}'); background-size:cover">
								<div class="overlay"></div>
								<h5>
								   
								    <?php $lang_org = session('language');
                                     if($lang_org=='')
                                     {
                                      echo $pos->position_en;
                                      }
                                      elseif($lang_org=='en'){
                                        echo $pos->position_en;  
                                      }
                                     else
                                      {
                                       echo $pos->position_ch;
                                      }
                                            			    
                                      ?>
								    <!--@lang('main.($pos[position])')-->
								</h5>
								<h4>
								    
								    <?php $lang_org = session('language');
                                     if($lang_org=='')
                                     {
                                      echo $pos->jobdesk_en;
                                      }
                                      elseif($lang_org=='en'){
                                        echo $pos->jobdesk_en;  
                                      }
                                     else
                                      {
                                       echo $pos->jobdesk_ch;
                                      }
                                            			    
                                      ?>
								    
								</h4>
									<section class="wrap-btn">
										<a href="#animatedModal-{{$no}}" class="btn-det demo0{{$no}}">@lang('main.detail')</a>
										<a href="{{ env('APP_URL') }}/addTest?id={{ Crypt::encrypt($pos->id) }}" class="btn-apply">@lang('main.apply')</a>
									</section>
								</div>
							</div>
						<?php
						$no++;
						} ?>

						</section>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php
$no = 1;
?>
<?php $lang_org = session('language'); 
foreach ($produk as $pos) { ?>
	<div id="animatedModal-{{$no}}">
		<div class="close-animatedModal-{{$no}}">
			<div id="closebt-container" class="close-animatedModal-{{$no}}">
				<img class="closebt" src="https://joaopereirawd.github.io/animatedModal.js/img/closebt.svg">
			</div>
		</div>
		<div class="modal-content">
			<div class="container container-custom">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="head">
<?php  if($lang_org=='')
 {
  echo $pos->position_en;
  }
  elseif($lang_org=='en'){
      echo $pos->position_en;
  }
 else
  {
   echo $pos->position_ch;
   }
?>
						    </h4>
						<br>
						<table class="detail-career">
							<tr>
								<td>@lang('main.career_title1')</td>
								<td>:</td>
								<td class="pad-left-20">

<?php  if($lang_org=='')
 {
  echo $pos->jobdesk_en;
  }
    elseif($lang_org=='en'){
      echo $pos->jobdesk_en;
  }
 else
  {
   echo $pos->jobdesk_ch;
   }
?>								    
							    </td>
							</tr>
							<tr>
								<td>@lang('main.career_title2')</td>
								<td>:</td>
								<td>
<?php  if($lang_org=='')
 {
  echo $pos->detRole_en;
  }
    elseif($lang_org=='en'){
      echo $pos->detRole_en;
  }
 else
  {
   echo $pos->detRole_ch;
   }
?>											
								</td>
							</tr>
							<tr>
								<td>@lang('main.career_title3')</td>
								<td>:</td>
								<td>
					
<?php  if($lang_org=='')
 {
  echo $pos->detRespon_en;
  }
elseif($lang_org=='en'){
      echo $pos->detRespon_en;
  }
 else
  {
   echo $pos->detRespon_ch;
   }
?>								    
								</td>
							</tr>
							<tr>
								<td>@lang('main.career_title4')</td>
								<td>:</td>
								<td>
							
<?php  if($lang_org=='')
 {
  echo $pos->detSkill_en;
  }
    elseif($lang_org=='en'){
      echo $pos->detSkill_en;
  }
 else
  {
   echo $pos->detSkill_ch;
   }
?>									    
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$no++;
} ?>

<script type="text/javascript">
$(document).ready(function () {
	<?php
	$no = 1;
	?>
	<?php foreach ($produk as $pos) { ?>
		$(".demo0{{$no}}").animatedModal();
	<?php
	$no++;
	} ?>
	});
</script>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>


	<br>
	<br>
    @include('pages.compro.follow')
@endsection
