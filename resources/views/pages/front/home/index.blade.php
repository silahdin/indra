@extends('layouts.appfront')

@section('content')

<script src="{{ asset('assets/front/assets/js/simple.money.format.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/front/assets/vendor/Font-Awesome/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/assets/vendor/checkboxes/build.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/assets/vendor/selected/css/selectize.css') }}">

<script>
$(document).ready(function() {
  //$('.money').simpleMoneyFormat();
});
</script>
<style>
    .img {
      height: 200px;
      width: 100%;
      display: block;
      object-fit: cover;
  }
</style>
<script src="{{ asset('assets/front/assets/vendor/selected/js/selectize.min.js') }}"></script>

  <style>
    .container-find-car{
      position: relative;
      z-index: 1;
      box-shadow: 2px 2px 3px 3px #1f1e1e61;
    }
      .inline-block{
          display: inline-block;
        }

      #preloader {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
      }
      #loader {
          display: block;
          position: relative;
          left: 50%;
          top: 50%;
          width: 150px;
          height: 150px;
          margin: -75px 0 0 -75px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #9370DB;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
      }
      #loader:before {
          content: "";
          position: absolute;
          top: 5px;
          left: 5px;
          right: 5px;
          bottom: 5px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #BA55D3;
          -webkit-animation: spin 3s linear infinite;
          animation: spin 3s linear infinite;
      }
      #loader:after {
          content: "";
          position: absolute;
          top: 15px;
          left: 15px;
          right: 15px;
          bottom: 15px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #FF00FF;
          -webkit-animation: spin 1.5s linear infinite;
          animation: spin 1.5s linear infinite;
      }
      @-webkit-keyframes spin {
          0%   {
              -webkit-transform: rotate(0deg);
              -ms-transform: rotate(0deg);
              transform: rotate(0deg);
          }
          100% {
              -webkit-transform: rotate(360deg);
              -ms-transform: rotate(360deg);
              transform: rotate(360deg);
          }
      }
      @keyframes spin {
          0%   {
              -webkit-transform: rotate(0deg);
              -ms-transform: rotate(0deg);
              transform: rotate(0deg);
          }
          100% {
              -webkit-transform: rotate(360deg);
              -ms-transform: rotate(360deg);
              transform: rotate(360deg);
          }
      }
  </style>
<!-- Banners -->
<div id="preloader" style="display: none">
    <div id="loader"></div>
</div>

<form action="{{ route('car.search') }}" method="POST">
    {{ csrf_field() }}
<section id="banner" class="banner-section" style="padding-top: 76px">
    <div class="container">
        <div class="row">
          <div class="col-md-5">

            <div class="container-find-car" style="background-color: white">
              <ul class="nav nav-pills">
                <li class="active">
                  <a data-toggle="pill" href="#home" class="head-pill">Find Your Dream Car</a>
                </li>
                <?php /*<li>
                  <a data-toggle="pill" href="#menu1" class="head-pill">Cek Harga</a>
                </li>*/ ?>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <div class="container-small-tab">
                    <?php /*<div class="row">
                      <div class="col-sm-12">

                        <div class="checkbox checkbox-danger  inline-block" style="padding-left: 10px">
                            <input type="radio" name="radio4" id="radio7" value="option1" checked>
                            <label class="label-radio" for="radio7">
                                Semua Kondisi
                            </label>
                        </div>
                        <div class="checkbox checkbox-danger  inline-block">
                            <input type="radio" name="radio4" id="radio8" value="option2">
                            <label class="label-radio" for="radio8">
                                Bekas
                            </label>
                        </div>
                        <div class="checkbox checkbox-danger  inline-block">
                            <input type="radio" name="radio4" id="radio9" value="option3">
                            <label class="label-radio" for="radio9">
                                Baru
                            </label>
                        </div>

                      </div>
                    </div>*/ ?>
                    <div class="row">
                      <div class="col-sm-12" >
                        <div class="control-group inline-block" style="width: 49.5%">
                          <select id="select-beast" name="merk" class="demo-default" placeholder="Chose Merk">
                            <option value="">Merek</option>
                            @foreach($merks as $merk)
                            <option value="{{ $merk->id }}">{{ $merk->name }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="control-group inline-block" style="width: 49.7%" id="DivModel">
                          <select id="select-beastA" name="type" class="demo-default" placeholder="Chose Type">
                          </select>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12" >
                        <div class="control-group inline-block" style="width: 49.5%">
                          <select id="select-beastB" name="kotamadya" class="demo-default" placeholder="Chose Kotamadya">
                            <option value="">Kotamadya</option>
                            @foreach($kotas as $kota)
                            <option value="{{ $kota->kotamadya_id }}">{{ ucwords(strtolower($kota->name)) }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="control-group inline-block" style="width: 23.5%">
                            <select id="select-beastC" name="range_min" class="demo-default" placeholder="Price Min">
                                <option value="">Harga Min</option>
                                <option value="25000000">25 Juta</option>
                                <option value="50000000">50 Juta</option>
                                <option value="100000000">100 Juta</option>
                                <option value="250000000">250 Juta</option>
                                <option value="500000000">500 Juta</option>
                                <option value="1000000000">1 Milyar</option>
                              </select>
                        </div>
                        <span style="width: 2%; position: relative;">
                          <span style="width: 2%; position: relative; visibility: hidden;">-
                          </span>
                          <span style="position: absolute;top: -14px;left:0; z-index: 4;">-</span>
                          </span>
                        <div class="control-group inline-block" style="width: 23.8%">
                          <select id="select-beastCC" name="range_max" class="demo-default" placeholder="Price Max">
                            <option value="">Harga Max</option>
                            <option value="25000000">25 Juta</option>
                                <option value="50000000">50 Juta</option>
                                <option value="100000000">100 Juta</option>
                                <option value="250000000">250 Juta</option>
                                <option value="500000000">500 Juta</option>
                                <option value="1000000000">1 Milyar</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12" >
                        <div class="control-group inline-block" style="width: 49.5%">
                          <select id="select-beasttr" name="transmisi" class="demo-default" placeholder="Transmisi">
                            <option value="">Pilih Transmisi</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                          </select>
                        </div>

                        <div class="control-group inline-block" style="width: 49.7%">
                          <div class="control-group inline-block" style="width: 48%">
                              <select id="select-beastfthn" name="from_thn" class="demo-default" placeholder="Dari Tahun">
                                  <option value="">Dari Tahun</option>
                                  @for ($i = date('Y')-40; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                  @endfor
                                </select>
                          </div>
                          <span style="width: 2%; position: relative;">
                            <span style="width: 2%; position: relative; visibility: hidden;">-
                            </span>
                            <span style="position: absolute;top: -14px;left:0; z-index: 4;">-</span>
                            </span>
                          <div class="control-group inline-block" style="width: 47%">
                            <select id="select-beasttthn" name="to_thn" class="demo-default" placeholder="Sampai Tahun">
                              <option value="">Sampai Tahun</option>
                              @for ($j = date('Y')-40; $j <= date('Y'); $j++)
                                <option value="{{ $j }}">{{ $j }}</option>
                              @endfor
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12" >
                        &nbsp;
                      </div>
                    </div>
                    <?php /*<div class="row">
                      <div class="col-sm-12" >
                        <div class="control-group inline-block" style="width: 100%">
                          <div class="relative">
                            <span class="fa fa-search icon-input"></span>
                            <select id="select-beastD" class="demo-default" name="word" placeholder="Apa yang sedang anda cari?">
                                <option value="">Merek</option>
                                <option value="1">BMW</option>
                                <option value="2">Mustsu</option>
                                <option value="3">Suzki</option>
                                <option value="4">Honda</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div> */ ?>

                    <div class="row">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btnc col-sm-12 tombol-iseng">Search</button>
                      </div>
                    </div>
                    <?php /*<div class="row">
                      <div class="colc-link-search col-sm-12 text-center">
                        <a class="link-tab-form" href="#">Pencarian lebih lanjut >></a>
                      </div>
                    </div> */ ?>
                  </div>
                </div>

                <?php /*<div id="menu1" class="tab-pane fade">
                  <div class="container-small-tab">
                    <div class="row">
                      <div class="col-sm-12">

                        <div class="control-group inline-block" style="width: 100%">
                          <select id="select-beastA2" class="demo-default" placeholder="Pilih harga">
                            <option value="">Merek</option>
                            <option value="1">BMW</option>
                            <option value="2">Mustsu</option>
                            <option value="3">Suzki</option>
                            <option value="4">Honda</option>
                          </select>
                        </div>


                        <div class="control-group inline-block" style="width: 100%">
                          <select id="select-beastB2" class="demo-default" placeholder="Pilih model">
                            <option value="">Model</option>
                            <option value="1">BMW</option>
                            <option value="2">Mustsu</option>
                            <option value="3">Suzki</option>
                            <option value="4">Honda</option>
                          </select>
                        </div>


                        <div class="control-group inline-block" style="width: 100%">
                          <select id="select-beastC2" class="demo-default" placeholder="Pilih tahun">
                            <option value="">Tahun</option>
                            <option value="1">BMW</option>
                            <option value="2">Mustsu</option>
                            <option value="3">Suzki</option>
                            <option value="4">Honda</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <button class="btn btnc btnc-green col-sm-12">Cari Harga</button>
                      </div>
                    </div>
                  </div>
                </div>*/ ?>

                <?php /*<div class="container-small-tab footer-tab">
                <div class="row">
                  <div class="col-sm-12" style="margin-bottom: 5px;">
                    <label class="font-s-11">Pencarian cepat untuk</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                      <button class="btn btnc btnc-orange col-sm-5 font-s-13" style="width: 42%"><span class="fa fa-fire"> </span> Hot Deals</button>
                        <span class="col-sm-1 font-s-13" style="width: 13%; margin-top: 8px"> atau </span>
                      <button class="btn btnc btnc-red col-sm-5 font-s-13 " style="width: 45%">Mobil Murah Bekas</button>
                  </div>
                </div>
              </div>*/ ?>




              </div>

            </div>

          </div>
          <div class="col-md-5 col-md-push-3">
            <?php /*<div class="banner_content">
              <h1>Find the right car for you.</h1>
              <p>We have more than a thousand cars for you to choose. </p>
              <a href="#" class="btn">Read More <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>*/ ?>
          </div>
        </div>
    </div>
  </section>
</form>
<!-- /Banners -->

<!-- Filter-Form -->
<?php /*<section id="filter_form" class="gray-bg">
  <div class="container">
    <h3>Find Your Dream Car <span>(Easy search from here)</span></h3>
    <div class="row">
      <form action="{{ route('car.search') }}" method="POST">
          {{ csrf_field() }}
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="dealer" id="dealer">
              <option value="">Pilih Dealer </option>
              @foreach($dealers as $dealer)
              <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="merk" id="merk">
              <option value="">Pilih Merk</option>

              @foreach($merks as $merk)
              <option value="{{ $merk->id }}">{{ $merk->name }}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="type" id="type">
              <option value="">Pilih Type</option>
              @foreach($types as $type)
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="tahun" id="tahun">
              <option value="">Year of Model </option>
              <?php
              foreach ( range( 2000, date('Y') ) as $i ) {
                print '<option value="'.$i.'">'.$i.'</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-9 col-sm-9 black_input">
          <label class="form-label">Kisaran Harga (Rp.)</label>
          <input id="price_range" name="price_range" type="text" class="span2 money" value="" data-slider-min="20000000" data-slider-max="500000000" data-slider-step="5" data-slider-value="[1000,5000]"/>
        </div>
        <?php /*<div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control">
              <option>Type of Car </option>
              <option>New Car</option>
              <option>Used Car</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6">
          <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button>
        </div>
      </form>
    </div>
  </div>
</section>*/ ?>
<!-- /Filter-Form -->

<!-- About -->
<section class="about-us-section section-padding">
  <div class="container">
    <div class="section-header text-center">
      <h2>Welcome <span>to CarForYou</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to  a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.</p>
    </div>

    <div class="row">

        <!-- Recently Listed New Cars -->
        <div class="tab-content">

            @foreach($cars as $car)

            <div class="col-list-3">
                    <div class="featured-car-list">
                      <div class="featured-car-img"> <a href="{{ route('car.detail', ['id' => $car->slug]) }}"><img src="{{ $car->image }}" class="img-responsive img" alt="Image"></a>
                        <?php /*<div class="label_icon">New</div>*/ ?>
                      </div>
                      <div class="featured-car-content">
                        <h6><a href="{{ route('car.detail', ['id' => $car->slug]) }}">{{ substr($car->name, 0, 30) }}</a></h6>
                        <div class="price_info">
                          <p class="featured-price">Rp. {{ number_format($car->price) }}</p>
                          <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ substr($car->dealer, 0, 30) }}</span></div>
                        </div>
                        <ul>
                          <li><i class="fa fa-car"></i>{{ $car->merk }}</li>
                          <li><i class="fa fa-folder-open" aria-hidden="true"></i>{{ substr($car->type, 0, 19) }}</li>
                          <li><i class="fa fa-calendar"></i>{{ $car->tahun }}</li>
                          <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ $car->transmisi }}</li>
                        </ul>
                      </div>
                    </div>
                  </div>
            @endforeach

          </div>

        </div>
      </div>

  </div>
</section>
<!-- /About -->


<!--Brands-->
@include('pages.front.brand')
<!-- /Brands-->



<script type="text/javascript">
  //   $('.selectpicker').selectpicker({
  //   style: 'btn-info',
  //   size: 4
  // });
          $('#select-beast').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beasttr').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastfthn').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beasttthn').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastA').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastB').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastC').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });
          $('#select-beastCC').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastA2').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastB2').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastC2').selectize({
            create: true,
            sortField: {
              field: 'value',
              direction: 'asc'
            },
            dropdownParent: 'body'
          });

          $('#select-beastD').selectize({
            // create: true,
            // sortField: {
            //   field: 'text',
            //   direction: 'asc'
            // },
            // dropdownParent: 'body'
              //maxItems: 1
          });

  $('#select-state').selectize({
  });

  $('#select-beastD-selectized').css("left","10px");


  </script>
  <script type="text/javascript">
    $("document").ready(function(){
      $('#select-beast').change(function(){
        var Pdata = {
            "merk": $("#select-beast option:selected").val()
          };

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            url: "{{ route('post.postmodel') }}",
            data: Pdata,
            cache: false,
            type: "POST",
            beforeSend: function() {
                $('#preloader').show();
            },
            success: function(msg){
                $('#preloader').hide();
                $("#DivModel").html(msg);
            },
            error: function(datapost){

            }
        });

      });
    });
    </script>
@endsection
