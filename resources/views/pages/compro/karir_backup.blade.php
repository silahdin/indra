@extends('layouts.appcompro')

@section('content')

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

<br>
<br>
<br>
<br>
<br>
<br>

<div class="section-content-career">
	<div class="container container-content">
		<div class="row">
			<div class="col-sm-12 col-btn-search">
				<div class="input-group date form_date col-md-12 art_tgl_berangkat area-date-input"
					data-link-field="dtp_input2" style="outline: none;">
					<input class="form-control tgl_berangkat" type="text" name="search" placeholder="Cari kerja"
						autocomplete="off">
					<button class="btn btn-primary btn-search-career">@lang('main.cari')</button>
				</div>
			</div>
		</div>
		<div class="row row-sort-career">
			<div class="col-sm-4">
				<span class="small-desk">1-{{$showData}} of {{$allData}} job matches</span>
			</div>
			<div class="col-sm-5 text-right">
				<!-- <span>Sortir</span> -->
			</div>
		</div>
		<div class="row row-min-12">
			<div class="col-sm-9">

				<?php foreach ($produk as $pos) { ?>
				<div class="row row-career">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-7 head-left">
								<h4 class="h4-career">
									<a href="#">{{$pos->position}}</a>
								</h4>
							</div>
							<div class="col-sm-5 text-right head-right">
								<span class="small-desk"><span
										class="fa fa-time-o"></span>{{convert_tgl_to_userEN($pos->date_start)}}</span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-9 info-career">
								<p class="info-career"><?=$pos->jobdesk_en?><br>
									<?=$pos->requirement_en?></p>
								<p style="color:#8c9090"><?=$pos->location?></p>
							</div>
							<div class="col-sm-3">
								<div class="w-button-career">
									<a href="#" class="btn btn-secondary">
										<img src="{{ asset($pos->img) }}" style="width:100%" alt="">
										<span>@lang('main.button_register')</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>

			<div class="col-sm-3">
				<div class="row">
					<div class="col-sm-12 text-center">
						<a href="{{ route('compro.meetOur') }}">
							<img src="{{ asset('assets/compro/assets/frontend_assets/images/career/Meet Our People.jpg') }}" alt="" width="100%">
						</a>
						<a style="display:block;" href="{{ route('compro.meetOur') }}" class="btn-meet">@lang('main.meet_people')</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				{{ $produk->links() }}
			</div>
		</div>
	</div>
</div>



@endsection
