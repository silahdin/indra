@extends('layouts.appfront')
@section('title', getSetting()->title .' - ' . $car->name)
@section('content')

<script src="{{ asset('assets/front/assets/js/holder.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/simple.money.format.js') }}"></script>

<script>
$(document).ready(function() {
  $('input.number').keyup(function(event) {
          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40) return;

          // format number
          $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
              ;
          });
  });
});
</script>
<style>
    .img {
      height: 200px;
      width: 100%;
      display: block;
      object-fit: cover;
      /*
      position: relative;
      float: left;
      width:  100px;
      height: 167px;
      background-position: 50% 50%;
      background-repeat:   no-repeat;
      background-size:     cover;*/
  }
</style>

<section id="banner-detail" class="banner-section" style="padding-top: 76px">
    <div class="container">
    <div class="listing_detail_head white-text div_zindex row">
      <div class="col-md-9">
        <h2>{{ $car->name }}</h2>
        <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $car->dealer }}</span></div>
        <?php /*<div class="add_compare">
          <div class="share_vehicle">
            <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
          </div>
        </div>*/ ?>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p style="font-size: 28px !important">Rp. {{ number_format($car->price) }}</p>
          <?php /*<p class="old_price">$95,000</p>*/ ?>
        </div>
      </div>
    </div>
    </div>
  <div class="dark-overlay"></div>
  </section>


<!-- /Listing-detail-header -->

<section class="listing_other_info secondary-bg">
  <div class="container">
    <?php /*<div id="filter_toggle" class="search_other"> <i class="fa fa-filter" aria-hidden="true"></i> Search Car </div>
    <div id="other_info"><i class="fa fa-info-circle" aria-hidden="true"></i></div>
    <div id="info_toggle">
      <button type="button" data-toggle="modal" data-target="#schedule"> <i class="fa fa-car" aria-hidden="true"></i> Schedule Test Drive </button>
      <button type="button" data-toggle="modal" data-target="#make_offer"> <i class="fa fa-money" aria-hidden="true"></i> Make an Offer </button>
      <button type="button" data-toggle="modal" data-target="#email_friend"> <i class="fa fa-envelope" aria-hidden="true"></i> Email to a Friend </button>
      <button type="button" data-toggle="modal" data-target="#more_info"> <i class="fa fa-file-text-o" aria-hidden="true"></i> Request More Info </button>
    </div>
    */ ?>
  </div>
</section>

<!-- Filter-Form -->
<section id="filter_form" class="inner-filter gray-bg">
  <div class="container">
    <h3>Find Your Dream Car <span>(Easy search from here)</span></h3>
    <div class="row">
      <form action="#" method="get">
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control">
              <option value="">Select Location </option>
              <option value="">Location 1 </option>
              <option value="">Location 1 </option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control">
              <option>Select Brand</option>
              <option>Brand 1</option>
              <option>Brand 2</option>
              <option>Brand 3</option>
              <option>Brand 4</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control">
              <option>Select Model</option>
              <option>Series 1</option>
              <option>Series 2</option>
              <option>Series 3</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
          <div class="select">
            <select class="form-control">
              <option>Year of Model </option>
              <option>2016</option>
              <option>2015</option>
              <option>2014</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-6 col-sm-6 black_input">
          <label class="form-label">Price Range ($)</label>
          <input id="price_range" type="text" class="span2" value="" data-slider-min="50" data-slider-max="6000" data-slider-step="5" data-slider-value="[1000,5000]"/>
        </div>
        <div class="form-group col-md-3 col-sm-6 black_input">
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
</section>
<!-- /Filter-Form -->

<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="listing_images">
          <div id="listing_images_slider" class="listing_images_slider">
            <div><img src="{{ URL::to('/') }}/{{ $car->image }}" alt="image" style="width: 900px"></div>
            <?php $imags = DB::table('car_image')
            ->where('car_id', $car->id)
            ->get() ?>
            @foreach($imags as $imag)
            <div><img src="{{ URL::to('/') }}/{{ $imag->images }}" alt="image"></div>
            @endforeach
          </div>
          <div id="listing_images_slider_nav" class="listing_images_slider_nav">
            <div><img src="../../{{ $car->image }}" alt="image"></div>
            @foreach($imags as $imagg)
            <div><img src="{{ URL::to('/') }}/{{ $imagg->images }}" alt="image"></div>
            @endforeach
          </div>
        </div>
        <?php /*<div class="main_features">
          <ul>
            <li> <i class="fa fa-tachometer" aria-hidden="true"></i>
              <h5>13,000</h5>
              <p>Total Kilometres</p>
            </li>
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5>2010</h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5>Diesel</h5>
              <p>Fuel Type</p>
            </li>
            <li> <i class="fa fa-power-off" aria-hidden="true"></i>
              <h5>Automatic</h5>
              <p>Transmission</p>
            </li>
            <li> <i class="fa fa-superpowers" aria-hidden="true"></i>
              <h5>153KW</h5>
              <p>Engine</p>
            </li>
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5>5</h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>*/ ?>
        <div class="listing_more_info">
          <div class="listing_detail_wrap">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Description </a></li>
              <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Spesifikasi</a></li>
              <?php /*<li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>*/ ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                {!! $car->description !!}
              </div>

              <!-- Technical-Specification -->
              <div role="tabpanel" class="tab-pane" id="specification">
                <div class="table-responsive">
                  <!--Basic-Info-Table-->
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">Spesifikasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><i class="fa fa-car"></i> Merk</td>
                        <td>{{ $car->merk }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-folder-open" aria-hidden="true"></i> Model</td>
                        <td>{{ $car->type }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-paint-brush"></i> warna</td>
                        <td>{{ $car->warna }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-calendar"></i> Tahun</td>
                        <td>{{ $car->tahun }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-gear"></i> Transmisi</td>
                        <td>{{ $car->transmisi }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-dashboard"></i> Kilometer</td>
                        <td>{{ $car->kilometer }}</td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-sticky-note"></i> Masa berlaku pajak (STNK)</td>
                        <td>{{ $car->pajak }}</td>
                      </tr>
                        <?php $fields = DB::table('car_field')
                        ->select('name_field as name', 'car_field.description')
                        ->where('car_id', $car->id)
                        ->get() ?>
                        @foreach($fields as $field)
                      <tr>
                        <td><i class="fa fa-check" aria-hidden="true"></i> {{ $field->name }} </td>
                        <td>{{ $field->description }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <?php /*<!--Technical-Specification-Table-->
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">Technical Specification</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Engine Type</td>
                        <td>TDCI Diesel Engine</td>
                      </tr>
                      <tr>
                        <td>Engine Description</td>
                        <td>1.5KW</td>
                      </tr>
                      <tr>
                        <td>No. of Cylinders</td>
                        <td>4</td>
                      </tr>
                      <tr>
                        <td>Mileage-City</td>
                        <td>22.4kmpl</td>
                      </tr>
                      <tr>
                        <td>Mileage-Highway</td>
                        <td>25.83kmpl</td>
                      </tr>
                      <tr>
                        <td>Fuel Tank Capacity</td>
                        <td>40 (Liters)</td>
                      </tr>
                      <tr>
                        <td>Seating Capacity</td>
                        <td>5</td>
                      </tr>
                      <tr>
                        <td>Transmission Type</td>
                        <td>Manual</td>
                      </tr>
                    </tbody>
                  </table>*/ ?>
                </div>
              </div>

              <!-- Accessories -->
              <?php /*<div role="tabpanel" class="tab-pane" id="accessories">
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>AntiLock Braking System</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Power Steering</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Power Windows</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>CD Player</td>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Leather Seats</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Central Locking</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Power Door Locks</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Brake Assist</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Driver Airbag</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Passenger Airbag</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Crash Sensor</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Engine Check Warning</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                      <td>Automatic Headlamps</td>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>*/ ?>
            </div>
          </div>

           <?php /*<!--Vehicle-Video-->
          <div class="video_wrap">
            <h6>Watch Video </h6>
            <div class="video-box">
               <iframe class="mfp-iframe" src="https://www.youtube.com/embed/rqSoXtKMU3Q" allowfullscreen></iframe>
            </div>
         </div>*/ ?>

         <?php /*<!--Comment-Form-->
          <div class="comment_form">
            <h6>Leave a Comment</h6>
            <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email Address">
              </div>
              <div class="form-group">
                <textarea rows="5" class="form-control" placeholder="Comments"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn" value="Submit Comment">
              </div>
            </form>
          </div>
          <!--/Comment-Form--> */ ?>

        </div>
      </div>

      <!--Side-Bar-->
      <aside class="col-md-3">

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-cart-plus" aria-hidden="true"></i> Nego / Bid </h5>
          </div>
          <div class="financing_calculatoe">
              <form action="{{ route('car.bid') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="mobil" id="mobil" value="{{ $car->id }}">
              <input type="hidden" name="ke" id="ke" value="{{ $car->dealer_id }}">
              <input type="hidden" name="model" id="model" value="{{ $car->name }}">
              <div class="form-group">
                <label class="form-label">Masukan Harga Nego (Rp.)</label>
                <input class="form-control number" type="text" name="bidding" id="bidding" required>
              </div>
              <div class="form-group">
                  <label class="form-label">Keterangan</label>
                  <input class="form-control" type="text" name="description" id="description" >
                </div>
              <div class="form-group">
                  @guest
                  <button type="button" class="btn btn-block" onclick="alert('Anda harus login terlebih dahulu untuk Nego/Bid mobil ini')">Send</button>
                  @else
                  <button type="submit" class="btn btn-block">Send</button>
                  @endguest
              </div>
            </form>
          </div>
        </div>


        <?php /*<div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-calculator" aria-hidden="true"></i> Financing Calculator </h5>
          </div>
          <div class="financing_calculatoe">
            <form action="#" method="get">
              <div class="form-group">
                <label class="form-label">Vehicle Price ($)</label>
                <input class="form-control" type="text">
              </div>
              <div class="form-group">
                <label class="form-label">Down Price ($)</label>
                <input class="form-control" type="text">
              </div>
              <div class="form-group">
                <label class="form-label">Interest Rate</label>
                <div class="select">
                  <select class="form-control select">
                    <option>12%</option>
                    <option>13%</option>
                    <option>14%</option>
                    <option>15%</option>
                    <option>16%</option>
                    <option>17%</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Period in Years</label>
                <div class="select">
                  <select class="form-control">
                    <option>3 Year</option>
                    <option>4 Year</option>
                    <option>5 Year</option>
                    <option>6 Year</option>
                    <option>7 Year</option>
                    <option>8 Year</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block">Calcuate</button>
              </div>
            </form>
          </div>
        </div>*/ ?>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-address-card-o" aria-hidden="true"></i> Dealer Contact </h5>
          </div>
          <div class="dealer_detail"> <img src="../../{{ $car->imgdealer }}" alt="image" style="height: 90px">
            <p><span>Dealer:</span> {{ $car->dealer }}</p>
            <p><span>Alamat:</span> {{ $car->address }}</p>
            <p><span>Telepon:</span> {{ $car->phone }}</p>
            <a href="{{ route('car.dealer', ['id' => $car->dealerslug]) }}" class="btn btn-xs">View Profile</a> </div>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h6><i class="fa fa-envelope" aria-hidden="true"></i> Kirim Pesan Dealer</h6>
          </div>
          <form action="{{ route('car.hubungikami') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="mobil" id="mobil" value="{{ $car->id }}">
            <input type="hidden" name="ke" id="ke" value="{{ $car->dealer_id }}">
            <input type="hidden" name="model" id="model" value="{{ $car->name }}">
            <div class="form-group">
              <textarea rows="4" class="form-control" placeholder="Pesan" name="pesan" required></textarea>
            </div>
            <div class="form-group">
                @guest
                <button type="button" class="btn btn-block" onclick="alert('Anda harus login terlebih dahulu untuk mengirim pesan ke Dealer')">Send</button>
                @else
                <button type="submit" class="btn btn-block">Send</button>
                @endguest
            </div>
          </form>
        </div>
      </aside>
      <!--/Side-Bar-->

    </div>
    <div class="space-20"></div>
    <div class="divider"></div>

    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">

        @foreach($similars as $sim)
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="{{ route('car.detail', ['id' => $sim->slug]) }}"><img src="../../{{ $sim->image }}" class="img-responsive img" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="{{ route('car.detail', ['id' => $sim->slug]) }}">{{ substr($sim->name,0,20) }}</a></h5>
              <p class="" style="font-size: 18px; margin-top: -18px">Rp. {{ number_format($sim->price) }}</p>
              <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $sim->dealer }}</span></div>
              <ul class="features_list">
                <li><i class="fa fa-car"></i>{{ $sim->merk }}</li>
                <li><i class="fa fa-folder-open" aria-hidden="true"></i>{{ substr($sim->type, 0, 13) }}...</li>
                <li><i class="fa fa-calendar"></i>{{ $sim->tahun }}</li>
                <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ $sim->transmisi }}</li>
              </ul>
            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>
    <!--/Similar-Cars-->

  </div>
</section>
<!--/Listing-detail-->

<!--Brands-->
@include('pages.front.brand')
<!-- /Brands-->

@endsection
