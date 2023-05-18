@extends('layouts.appfront')
@section('title', getSetting()->title .' - Hubungi Kami')
@section('content')

<script>
$(document).ready(function() {
    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
});
</script>

<!--Page Header-->
<section class="page-header contactus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Hubungi Kami</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="{{ route('welcome') }}">Home</a></li>
        <li>Hubungi Kami</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Contact-us-->
<section class="contact_us section-padding">
  <div class="container">
    <div  class="row">
            @if (Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            </div>
            @endif
      <div class="col-md-6">
        <h3>Get in touch using the form below</h3>
        <div class="contact_form gray-bg">
        <form action="{{ route('send.hubungikami') }}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
              <label class="control-label">Nama Lengkap <span>*</span></label>
              <input type="text" class="form-control white_bg" id="fullname" name="nama" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email <span>*</span></label>
              <input type="email" class="form-control white_bg" id="emailaddress" name="email" required>
            </div>
            <div class="form-group">
              <label class="control-label">Nomer HP <span>*</span></label>
              <input type="text" class="form-control white_bg numbersOnly" id="phonenumber" name="nomer_hp" required>
            </div>
            <div class="form-group">
              <label class="control-label">Pesan <span>*</span></label>
              <textarea class="form-control white_bg" rows="4" name="pesan" required></textarea>
            </div>
            <div class="form-group">
              <button class="btn" type="submit">Kirim Pesan <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <h3>Contact Info</h3>
        <div class="contact_detail">
          <ul>
            <li>
              <div class="icon_wrap"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
              <div class="contact_info_m">{{ getSetting()->alamat }}</div>
            </li>
            <li>
              <div class="icon_wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
              <div class="contact_info_m"><a href="tel:{{ getSetting()->no_tlp }}">{{ getSetting()->no_tlp }}</a></div>
            </li>
            <li>
              <div class="icon_wrap"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
              <div class="contact_info_m"><a href="mailto:{{ getSetting()->email }}">{{ getSetting()->email }}</a></div>
            </li>
          </ul>
          <div class="map_wrap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26361315.424069386!2d-113.75658747371207!3d36.241096924675375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1483614660041" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Contact-us-->

<!--Brands-->
@include('pages.front.brand')
<!-- /Brands-->

@endsection
