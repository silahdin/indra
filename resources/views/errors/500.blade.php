<?php

  $title = new \stdClass();
  $title->title_in = 'There was something went wrong';
  $title->title_en = 'There was something went wrong';

  $footer = DB::table('cms_contact')
  ->where('id', 1)
  ->first();

  $tata = DB::table('cms_goverment')
  ->first();


  $serv = DB::table('cms_servicelist')
  ->orderBy('name', 'ASC')
  ->get();

  $menuTop = DB::table('cms_pages')
  ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
  ->where('cms_pages.rowstate', 1)
  ->where('cms_pages.position', 2)
  ->orderBy('cms_pages.id', 'ASC')
  ->get();

  $menuMiddle = DB::table('cms_pages')
  ->leftJoin('cms_position', 'cms_position.position_id', '=', 'cms_pages.position')
  ->where('cms_pages.rowstate', 1)
  ->where('cms_pages.position', 1)
  ->orderBy('cms_pages.id', 'ASC')
  ->get();
  $setting = DB::table('cms_setting')
  ->where('id', 1)
  ->first();


  $produk = DB::table('cms_career')
  ->where('rowstate', 1)
  // ->orderBy('date_start', 'ASC')
  ->paginate(10);


  $allProduk = DB::table('cms_career')
  ->where('rowstate', 1)
  // ->orderBy('date_start', 'ASC')
  ->get();



  $imgTop = DB::table('cms_img_top')
  ->where('id', 1)
  ->first();


  $footerTrain = DB::table('cms_training')
  ->where('rowstate', 1)
  ->orderBy('id', 'ASC')
  ->get();

?>

@extends('layouts.appcompro_test', [
    'servs' =>  $serv,
    'produk' =>  $produk,
    'setting' =>  $setting,
    'tata' =>  $tata,
    'footerTrain' =>  $footerTrain,
    'menuTop' =>  $menuTop,
    'menuMiddle' =>  $menuMiddle,
    'footer' =>  $footer,
    'title' =>  $title,
    'imgTop' =>  $imgTop,
    'allProduk' => $allProduk
  ])

@section('content')

<div class="space-top"></div><br>

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/about.jpg');
?>
<div class="section-one text-center margin-right-0" style="background-image: url('{{$imgBanner}}');">
  <!-- <div class="wrapper-color"></div> -->
  <div class="container container-content">
    <div class="row ">
      <div class="col-sm-12 color-white">
        <div class="content-section-one">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
              <!-- <h2 class="h2-opening">Tentang Recare</h2> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section-content-about">
  <div class="container container-content container-form-about">
    <div class="wrapper-about">

      <div class="row row-about-tim" id="servis">
        <div class="col-sm-12 text-center">
          <h1>Something went wrong</h1>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="not_found_msg">
            <div class="error_msg_div">
              <h3>Sorry for the inconvenience</h3>
              <p>Please report this to our team to fix or improve this issue. <br> We appreciate for your cooperation.</p>
              <a href="{{ route('compro.home') }}">Go to Main Page<span class="angle_arrow"></span></a>
            </div>
          </div>
        </div>

      </div>


    </div>
  </div>
</div>

@endsection