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

              <h4>Frequently Asked Questions</h4>

            </div>
        </div>

		    <br> 

        <?php
            $faqGroups = DB::table('new_cms_career_faq_group')->get();
        ?>

        @if($faqGroups->count() > 0)

            <div class="row">

                @foreach($faqGroups as $faqGroup)

                    <div class="col-md-6 col-sm-12" style="padding-bottom: 7px;">
                      <a href="javascript:void(0);" class="btnc-more" style="padding:5px 15px;margin:inherit; width: 100%;" onclick="initFaq({{ @$faqGroup->id }})">{!! @$faqGroup->group !!}</a>
                    </div>

                @endforeach

            </div>

            <br>            

            @foreach($faqGroups as $faqGroup)
                <?php
                    $faqs = DB::table('new_cms_career_faq')->where('group_id', $faqGroup->id)->get();
                ?>

                @if($faqs->count() > 0)

                    <div id="group{{ $faqGroup->id }}" class="row detailFaq">

                        <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 30px;">

                          <h4>{{ $faqGroup->group }}</h4>

                        </div>

                        @foreach($faqs as $faq)

                            <button class="accordion">{{ @$faq->question }}</button>
                            <div class="panel">
                                <p>{!! @$faq->answer !!}</p>
                            </div>

                        @endforeach

                    </div>

                @endif

            @endforeach


        @endif

        
       

	</div>
</div>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection

@push('scripts')
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

<script>
$(document).ready(function(){

    <?php
        $firstGroup = DB::table('new_cms_career_faq_group')->first();
    ?>

    @if($firstGroup)
        initFaq({{ @$firstGroup->id }});
    @else
        initFaq();
    @endif
});

function initFaq(param = ""){
    $('.detailFaq').hide();

    if(param != ""){
        $('#group'+param).show();
    }
}
</script>

@endpush

@push('styles')
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

.accordion:focus {
    outline: 0px;
}

.active, .accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.panel p {
    display: block;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
}

.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  width: 100%;
}
</style>
@endpush
