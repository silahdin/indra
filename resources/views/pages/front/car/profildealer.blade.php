@extends('layouts.appfront')
@section('title', getSetting()->title .' - Profile ' . $d->name)
@section('content')
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
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>{{ $d->name }}</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="{{ route('welcome') }}">Home</a></li>
        <li>Dealers Profile</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Dealer-profile-->
<section class="dealer_profile inner_pages">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-4">
        <div class="dealer_logo"> <img src="../../{{ $d->images }}" alt="image"> </div>
      </div>
      <div class="col-md-6 col-sm-5 col-xs-8">
        <div class="dealer_info">
          <h4>{{ $d->name }}</h4>
          <p>{{ $d->address }}</p>
          <ul class="dealer_social_links">
            <li class="facebook-icon"><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
            <li class="twitter-icon"><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
            <li class="linkedin-icon"><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
            <li class="google-plus-icon"><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="dealer_contact_info gray-bg">
          <h6><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
          <a href="mailto:{{ $d->email }}">{{ $d->email }}</a> </div>
        <div class="dealer_contact_info gray-bg">
          <h6><i class="fa fa-phone" aria-hidden="true"></i> Nomer Telepon</h6>
          <a href="tel:{{ $d->phone }}">{{ $d->phone }}</a> </div>
      </div>
    </div>
    <div class="space-60"></div>
    <div class="row">
      <div class="col-md-9">
        <div class="dealer_listings">
          <h6>Mobil Lainnya dari {{ $d->name }}</h6>
          <div class="row">

              @foreach($similars as $sim)

              <?php $fields = DB::table('car_field')
            ->where('car_id', $sim->id)
            ->skip(0)->take(1)
            ->get() ?>
            <div class="col-md-4 grid_listing">
              <div class="product-listing-m gray-bg">
                <div class="product-listing-img"> <a href="#"><img src="../../{{ $sim->image }}" class="img-responsive img" alt="image" /> </a>
                </div>
                <div class="product-listing-content">
                  <h5><a href="{{ route('car.detail', ['id' => $sim->slug]) }}">{{ str_limit($sim->name,17) }}</a></h5>
                  <p class="list-price">Rp. {{ number_format($sim->price) }}</p>
                  <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $sim->city }}</span></div>
                  <ul class="features_list">
                      <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ str_limit($sim->merk,11) }}</li>
                      <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ str_limit($sim->type,11) }}</li>
                      <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ $sim->tahun }}</li>
                      @foreach($fields as $field)
                      <li><i class="fa fa-certificate" aria-hidden="true"></i>{{ str_limit($field->description,11) }}</li>
                      @endforeach
                  </ul>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
      <aside class="col-md-3">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h6><i class="fa fa-envelope" aria-hidden="true"></i> Kirim Pesan Dealer</h6>
          </div>
          @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
          <form action="{{ route('senddealer.hubungikami') }}" method="post">
              {{ csrf_field() }}
            @guest
            <input type="hidden" name="status" id="status" value="pengunjung">
            <input type="hidden" name="ke" id="ke" value="{{ $d->user_id }}">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nama" name="nama" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nomer HP" name="nomer_hp" id="nomer_hp">
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" placeholder="Pesan" name="pesan" id="pesan" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Kirim Pesan" class="btn btn-block">
            </div>

            @else
            <input type="hidden" name="status" id="status" value="member">
            <input type="hidden" name="ke" id="ke" value="{{ $d->user_id }}">
            <div class="form-group">
              <textarea rows="4" class="form-control" placeholder="Pesan" name="pesan" id="pesan" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Kirim Pesan" class="btn btn-block">
            </div>
            @endguest
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!--/Dealer-profile-->

<!--Brands-->
@include('pages.front.brand')
<!-- /Brands-->

@endsection
