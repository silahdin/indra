<?php //use \Auth as log; ?>
<?php $set = DB::table('setting')->first() ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="{{ $set->keywords }}">
<meta name="description" content="{{ $set->description }}">
<title>@yield('title', getSetting()->title)</title>
<!--Bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/front/assets/css/bootstrap.min.css') }}" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="{{ asset('assets/front/assets/css/style.css') }}" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="{{ asset('assets/front/assets/css/owl.carousel.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/front/assets/css/owl.transitions.css') }}" type="text/css">
<!--slick-slider -->
<link href="{{ asset('assets/front/assets/css/slick.css') }}" rel="stylesheet">
<!--bootstrap-slider -->
<link href="{{ asset('assets/front/assets/css/bootstrap-slider.min.css') }}" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="{{ asset('assets/front/assets/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom Colors -->
<link rel="stylesheet" href="{{ asset('assets/front/assets/colors/red.css') }}">
<!--<link rel="stylesheet" href="assets/colors/orange.css">-->
<!--<link rel="stylesheet" href="assets/colors/blue.css">-->
<!--<link rel="stylesheet" href="assets/colors/pink.css">-->
<!--<link rel="stylesheet" href="assets/colors/green.css">-->
<!--<link rel="stylesheet" href="assets/colors/purple.css">-->

<!-- Fav and touch icons -->
<?php /*<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/front/assets/images/favicon-icon/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/front/assets/images/favicon-icon/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/front/assets/images/favicon-icon/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/front/assets/images/favicon-icon/apple-touch-icon-57-precomposed.png') }}">*/ ?>
<link rel="shortcut icon" href="favicon.jpg">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="{{ asset('assets/front/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('#buttonSend').addClass('disabled');
    $('#terms_agree').on('click', function() {
     if ($('#terms_agree').length > 0 ) {
          $('#terms_agree').removeClass('disabled'); // remove red border
         $('#terms_agree').attr('disabled', 'true'); // disable button
         $('#buttonSend').removeClass('disabled'); // remove class diabled so user can click button
    }
    });
});
</script>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({ placeholder: 'Pilih Kotamadya', width: '100%' });
});
</script>
</head>
<body>

<!--Header-->
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">

        @if(count($errors))
        <script>
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 6000);
        </script>
          @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> {{ $error }}
            </div>
          @endforeach
      @endif

      <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="{{ route('compro.home') }}"><img src="{{ asset('assets/front/assets/images/logo.png') }}" alt="image"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:{{ getSetting()->email }}">{{ getSetting()->email }}</a> </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:{{ getSetting()->no_tlp }}">{{ getSetting()->no_tlp }}</a> </div>
            <div class="social-follow">
              <ul>
                <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              </ul>
            </div>

            @guest
            <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
            @else
            <div class="login_btn"> <a href="{{ route('dashboard') }}" class="btn btn-xs uppercase">Dashboard</a> </div>
            @endguest
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
          @guest
          @else
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('profile.dealer') }}">Profile</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Sign Out</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </ul>
            </li>
          </ul>
        </div>
        @endguest
        <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="{{ route('home.search') }}" method="POST" id="header-search-form">
            {{ csrf_field() }}
            <input type="text" placeholder="Search..." class="form-control" name="q" id="q">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li class=""><a href="{{ route('welcome') }}">Home</a></li>
          <li><a href="{{ route('tentang.kami') }}">About Us</a></li>
          <li><a href="{{ route('hubungi.kami') }}">Contact Us</a></li>
          <?php /*<li class="dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inventory</a>
            <ul class="dropdown-menu">
              <li><a href="listing-grid.html">Grid Style</a></li>
              <li><a href="listing-classic.html">Classic Style</a></li>
              <li><a href="listing-detail.html">Detail Page Style 1</a></li>
              <li><a href="listing-detail-2.html">Detail Page Style 2</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dealers</a>
            <ul class="dropdown-menu">
              <li><a href="dealers-list.html">List View</a></li>
              <li><a href="dealers-profile.html">Detail Page</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
            <ul class="dropdown-menu">
              <li><a href="services.html">Services</a></li>
              <li><a href="contact-us.html">Contact Us</a></li>
              <li><a href="compare.html">Compare Vehicles</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="404.html">404 Error</a></li>
              <li><a href="coming-soon.html">Coming Soon</a></li>
            </ul>
          </li>*/ ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->

</header>
<!-- /Header -->

@yield('content')


<!--Footer -->
<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <h6>Tentang Kami</h6>
          {{ getSetting()->desc_footer }}
        </div>
        <div class="col-md-3 col-sm-6">
          <h6>Menu</h6>
          <ul>
            <li class=""><a href="{{ route('welcome') }}">Beranda</a></li>
            <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
            <li><a href="{{ route('hubungi.kami') }}">Hubungi Kami</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6>Hubungi Kami</h6>
          <ul>
            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="#"> {{ getSetting()->alamat }}</a></li>
            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{ getSetting()->no_tlp }}">{{ getSetting()->no_tlp }}</a></li>
            <li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:{{ getSetting()->email }}">{{ getSetting()->email }}</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6>Berlangganan Newsletter</h6>
          <div class="newsletter-form">
              @if (Session::has('subscribe'))
              <div class="alert alert-success">{{ Session::get('subscribe') }}</div>
              @endif
            <form action="{{ route('send.subscribe') }}" method="post">
                {{ csrf_field() }}
              <div class="form-group">
                <input type="email" class="form-control newsletter-input" required placeholder="Alamat Email" name="email" id="semail" />
              </div>
              <button type="submit" class="btn btn-block">Subscribe <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
            <p class="subscribed-text">*We send great deals and latest auto news to our subscribed users every week.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <?php /*<div class="footer_widget">
            <p>Download Our APP:</p>
            <ul>
              <li><a href="#"><i class="fa fa-android" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-apple" aria-hidden="true"></i></a></li>
            </ul>
          </div>*/ ?>
          <div class="footer_widget">
            <p>Connect with Us:</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">Copyright &copy; 2017 Gratama. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-Form -->
<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-12">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="form-group">
                    <input id="lemail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group checkbox">
                    <input type="checkbox"  id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>


      <div class="modal-footer text-center">
        <p>Dont have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
      </div>

    </div>
  </div>
</div>
<!--/Login-Form -->

<!--Register-Form -->
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-12">
              <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nama Dealer"  value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control{{ $errors->has('telepon') ? ' is-invalid' : '' }} numbersOnly" placeholder="No Handphone" name="telepon" value="{{ old('telepon') }}" required>
                      @if ($errors->has('telepon'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('telepon') }}</strong>
                        </span>
                    @endif
                  </div>
                  </div>
                </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input id="form_choose_password" type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input id="form_re_enter_password" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <textarea name="address" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Alamat" required></textarea>
              @if ($errors->has('address'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
              @endif
            </div>

            <?php
            $hkotas = DB::table('kotamadya')
            ->orderBy('name', 'ASC')
            ->get();
            ?>
            <div class="form-group">
              <select class="form-control select2" name="kotamadya" id="kotamadya">
                <option value="">Pilih Kotamadya</option>
                @foreach($hkotas as $hkota)
                  <option value="{{ $hkota->kotamadya_id }}">{{ $hkota->name }}</option>
                @endforeach
              </select>
              @if ($errors->has('kotamadya'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('kotamadya') }}</strong>
                </span>
              @endif
            </div>

                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" name="terms_agree" required>
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" id="buttonSend" value="Sign Up" class="btn btn-block">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>
<!--/Register-Form -->

<!--Forgot-password-Form -->
<div class="modal fade" id="forgotpassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Password Recovery</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="forgotpassword_wrap">
            <div class="col-md-12">
              <form action="{{ route('password.email') }}" method="POST">
                  @csrf
                <div class="form-group">
                  <input type="email" name="email" id="psemail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Your Email address*" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                  <input type="submit" value="Reset My Password" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                <p class="gray_text">For security reasons we dont store your password. Your password will be reset and a new one will be send.</p>
                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Forgot-password-Form -->

<!-- Scripts -->
<script src="{{ asset('assets/front/assets/js/interface.js') }}"></script>
<!--bootstrap-slider-JS-->
<script src="{{ asset('assets/front/assets/js/bootstrap-slider.min.js') }}"></script>
<!--Slider-JS-->
<script src="{{ asset('assets/front/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/front/assets/js/owl.carousel.min.js') }}"></script>

</body>
</html>
