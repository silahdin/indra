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

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/career.jpg');
?>
<div class="space-top">
</div>

<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
    <div class="boxes">
        <h1>Career</h1>
    </div>
</section>
<br>
<br>
<div class="section-content-career">
	<div class="container container-content">
		<div class="row">
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
		</div>
		<div class="row row-sort-career">
			<div class="col-sm-4">
				<span class="small-desk">1-{{$showData}} of {{$allData}} job matches</span>
			</div>
			<div class="col-sm-5 text-right">

			</div>
		</div>
		<div class="row row-min-12">
			<div class="col-sm-9">
				<div class="row">
					<?php foreach ($produk as $pos) { ?>
						<div class="col-sm-6">
						<?php
						$img = $pos->img;
						?>
							<div class="wrap-career flex-box" style="background: url('{{ asset($img) }}'); background-size:cover">
							<div class="overlay"></div>	
							<h5>{{$pos->position}}</h5>
							<h4>{{$pos->jobdesk_in}}</h4>
								<div class="wrap-btn">
									<a href="" class="btn-det">Detailww</a>
									<a href="" class="btn-apply">Apply</a>
								</div>	
							</div>
						</div>
					<?php } ?>
				</div>
			</div>

			<!-- <div class="col-sm-3">
				<div class="row">
					<div class="col-sm-12 text-center">
						<a href="{{ route('compro.meetOur') }}">
							<img src="{{ asset('assets/compro/assets/frontend_assets/images/career/Meet Our People.jpg') }}" alt="" width="100%">
						</a>
						<a style="display:block;" href="{{ route('compro.meetOur') }}" class="btn-meet">Meet Our People</a>
					</div>
				</div>
			</div> -->
		</div>
		<!-- <div class="row">
			<div class="col-sm-9">
				{{ $produk->links() }}
			</div>
		</div> -->
		<div class="row">
			<div class="col-sm-12">

			</div>
		</div>
	</div>
</div>



@endsection