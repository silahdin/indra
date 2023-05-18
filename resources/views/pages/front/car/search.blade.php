@extends('layouts.appfront')
@section('title', getSetting()->title .' - Pencarian')
@section('content')

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
          url: "{{ route('post.postmodelsearch') }}",
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
  <style>
    .container-find-car{
      position: relative;
      z-index: 1;
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
<section class="page-header listing_page">
        <div class="container">
          <div class="page-header_wrap">
            <div class="page-heading">
              <h1>Car Listing</h1>
            </div>
            <ul class="coustom-breadcrumb">
              <li><a href="{{ route('welcome') }}">Home</a></li>
              <li>Car Listing</li>
            </ul>
          </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
      </section>
      <!-- /Page Header-->

      <!--Listing-->
      <section class="listing-page">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-md-push-3">
              <div class="result-sorting-wrapper">
                <div class="sorting-count">
                  @if(count($cars) > 0)
                  <p><strong>{{ number_format(count($cars)) }} Mobil {{ $merkmobil }} {{ $typemobil }} {{ $trans }} Dijual {{ ucwords(strtolower($kotamadyamobil)) }} {{ $ftahun }} {{ $ttahun }}</strong></p>
                  @else
                  <p>Mobil Dijual Tidak Ditemukan</p>
                  @endif
                </div>
                <?php /*
                <div class="result-sorting-by">
                  <p>Sort by:</p>
                  <form action="#" method="post">
                    <div class="form-group select sorting-select">
                      <select class="form-control ">
                        <option>Price (low to high)</option>
                        <option>$100 to $500</option>
                        <option>$500 to $1000</option>
                        <option>$1000 to $1500</option>
                        <option>$1500 to $2000</option>
                      </select>
                    </div>
                  </form>
                </div>
                */ ?>
              </div>

              <?php //print_r($_POST); ?>

              @foreach($cars as $car)

              <?php $fields = DB::table('car_field')
                ->where('car_id', $car->id)
                ->skip(0)->take(3)
                ->get() ?>

              <div class="product-listing-m gray-bg">
                <div class="product-listing-img"> <a href="{{ route('car.detail', ['id' => $car->slug]) }}"><img src="{{ URL::to('/') }}/{{ $car->image }}" class="img-responsive" alt="image" /> </a>
                </div>
                <div class="product-listing-content">
                  <h5><a href="{{ route('car.detail', ['id' => $car->slug]) }}">{{ $car->name }}</a></h5>
                  <p class="list-price">Rp. {{ number_format($car->price) }}</p>
                  <ul>
                        <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ $car->merk }}</li>
                        <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ substr($car->type, 0, 15) }}</li>
                        <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ $car->tahun }}</li>
                        @foreach($fields as $field)
                        <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ substr($field->description, 0, 15) }}</li>
                        @endforeach
                  </ul>
                  <a href="{{ route('car.detail', ['id' => $car->slug]) }}" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                  <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $car->dealer }}</span></div>
                </div>
              </div>
              @endforeach

              <?php /*<div class="pagination">
                <ul>
                  <li class="current">1</li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                </ul>
              </div>*/ ?>

            </div>

            <!--Side-Bar-->
            <aside class="col-md-3 col-md-pull-9">
              <div class="sidebar_widget">
                <div class="widget_heading">
                  <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
                </div>
                <div class="sidebar_filter">
                  <form action="{{ route('car.search') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group select">
                      <select class="form-control" id="select-beast" name="merk">
                        <option value="">Pilih Merk</option>
                        @foreach($merks as $merk)
                          <option value="{{ $merk->id }}">{{ $merk->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group select" id="DivModel">
                      <select class="form-control" name="type">
                        <option value="">Pilih Type</option>
                      </select>
                    </div>

                    <div class="form-group select">
                      <select class="form-control" >
                        <option value="">Pilih Kotamadya</option>
                        @foreach($kotas as $kota)
                          <option value="{{ $kota->kotamadya_id }}">{{ ucwords(strtolower($kota->name)) }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group select">
                      <select class="form-control" name="range_min" placeholder="Price Min">
                        <option value="">Harga Min</option>
                        <option value="25000000">25 Juta</option>
                        <option value="50000000">50 Juta</option>
                        <option value="100000000">100 Juta</option>
                        <option value="250000000">250 Juta</option>
                        <option value="500000000">500 Juta</option>
                        <option value="1000000000">1 Milyar</option>
                      </select>
                    </div>

                    <div class="form-group select">
                      <select class="form-control" name="range_max" placeholder="Price Max">
                        <option value="">Harga Max</option>
                        <option value="25000000">25 Juta</option>
                        <option value="50000000">50 Juta</option>
                        <option value="100000000">100 Juta</option>
                        <option value="250000000">250 Juta</option>
                        <option value="500000000">500 Juta</option>
                        <option value="1000000000">1 Milyar</option>
                      </select>
                    </div>

                    <div class="form-group select">
                      <select class="form-control" name="transmisi" placeholder="Transmisi">
                        <option value="">Pilih Transmisi</option>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                      </select>
                    </div>


                    <div class="form-group select">
                      <select class="form-control" name="from_thn" placeholder="Tahun Dari">
                        <option value="">Tahun Dari</option>
                        @for ($i = date('Y')-40; $i <= date('Y'); $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      </select>
                    </div>

                    <div class="form-group select">
                      <select class="form-control" name="to_thn" placeholder="Tahun Sampai">
                        <option value="">Tahun Sampai</option>
                        @for ($i = date('Y')-40; $i <= date('Y'); $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                      </select>
                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="sidebar_widget sell_car_quote">
                <div class="white-text div_zindex text-center">
                  <h3>Sell Your Car</h3>
                  <p>Request a quote and sell your car now!</p>
                  <a href="#" class="btn">Request a Quote <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
                <div class="dark-overlay"></div>
              </div>
              <div class="sidebar_widget">
                <div class="widget_heading">
                  <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
                </div>
                <div class="recent_addedcars">
                  <ul>

                    <?php
                    $recent = DB::table('push')
                    ->select('cars.name', 'cars.slug', 'cars.image', 'cars.price')
                    ->leftJoin('cars', 'cars.id', '=', 'push.car_id')
                    ->leftJoin('dealers', 'dealers.id', '=', 'cars.dealer_id')
                    ->leftJoin('merk_mobil', 'merk_mobil.id', '=', 'cars.merk')
                    ->leftJoin('type_mobil', 'type_mobil.id', '=', 'cars.type')
                    ->where('push.to_date', '>=', date('Y-m-d'))
                    ->orderBy('push.to_date', 'ASC')
                    ->take(5)
                    ->orderByRaw("RAND()")
                    ->get();
                    ?>
                    @foreach($recent as $b)
                    <li class="gray-bg">
                      <div class="recent_post_img"> <a href="{{ route('car.detail', ['id' => $b->slug]) }}"><img src="{{ URL::to('/') }}/{{ $b->image }}" alt="image"></a> </div>
                      <div class="recent_post_title"> <a href="{{ route('car.detail', ['id' => $b->slug]) }}">{{ str_limit($b->name,14) }}</a>
                        <p class="widget_price">Rp. {{ number_format($b->price) }}</p>
                      </div>
                    </li>
                    @endforeach

                  </ul>
                </div>
              </div>
            </aside>
            <!--/Side-Bar-->
          </div>
        </div>
      </section>
      <!-- /Listing-->

      <!--Brands-->
      @include('pages.front.brand')
      <!-- /Brands-->

@endsection
