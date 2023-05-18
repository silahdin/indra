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

        <div class="row">
            <div class="col-sm-12">

              {!! $text->text !!}

            </div>
        </div>

		    <br>

        <?php
            $ourPeoples = DB::table('new_cms_meet_peoples')->get();
        ?>

        @if($ourPeoples->where('status', 1)->count() > 0)

        <?php
            $colCount = floor(12/$ourPeoples->where('status', 1)->count());
            if($colCount < 4) $colCount = 4;
        ?>

        <div class="row person-leader row-meet-us-3">

            @foreach($ourPeoples as $ourPeople)

                @if($ourPeople->status == 1)

                    <div class="col-md-{{ $colCount }} col-sm-3">
                        <div class="box-people">
                            <div class="wrap-img">
                                <a href="{{  route('meet.people.detail', ['id' => Crypt::encrypt($ourPeople->id)]) }}">

                                <img src="{{ asset(@$ourPeople->image_url) }}" alt=""></a>
                            </div>
                            <strong>{{ @$ourPeople->name }}</strong>
                            <p>{{ @$ourPeople->position }}</p>
                        </div>
                    </div>

                @endif

            @endforeach

        </div>

        @endif
	</div>
</div>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
