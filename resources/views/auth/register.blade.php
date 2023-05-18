@extends('layouts.appcompro')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="space-top"></div>

<br>
<br>
<!--Page Header-->
<section class="page-header contactus_page">
  <div class="container">
    <div class="page-header_wrap">


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
      <div class="col-md-12">
        <h3>Registration Form</h3><br>
        <div class="contact_form gray-bg">
          <form method="POST" action="{{ url('register') }}">
            <?php 
              if(Input::has('id')){
                $dId = Input::get('id');
              } else {
                  $dId = Crypt::encrypt(0);
              }
            ?>
            <input type="hidden" name="idjob" value="{{$dId}}">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label class="control-label">First Name</span></label>
                          <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }} white_bg" name="first_name" value="{{ old('first_name') }}"  autofocus placeholder="First Name">
                          @if ($errors->has('first_name'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('first_name') }}</strong>
                              </span>
                          @endif
                    </div>
                    <div class="col-6">
                        <label class="control-label">Last Name</span></label>
                          <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }} white_bg" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                          @if ($errors->has('last_name'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('last_name') }}</strong>
                              </span>
                          @endif
                    </div>
                </div>
              
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label class="control-label">Birthday</span></label>
                          <div class="input-group-icon">
                            <input class="input--style-4 js-datepicker form-control" type="text" name="birthday" value="{{ old('birthday') }}"  placeholder="Birthday">
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                            @if ($errors->has('birthday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="control-label">Gender</label>
                        <div class="p-t-10">
                            <label class="radio-container m-r-45">Male
                                <input type="radio" checked="checked" name="gender" value="male">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">Female
                                <input type="radio" name="gender" value="female">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                            @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                    </div>
                </div>
              
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label class="control-label">Email</label>
                        <input class="input--style-4 form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}"  placeholder="Email">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="col-6">
                        <label class="control-label">Phone Number</label>
                        <input class="input--style-4 form-control" type="text" name="phone" value="{{ old('phone') }}"  placeholder="Phone Number">
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                       <label class="control-label">Password</label>
                        <input class="input--style-4 form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                    </div>
                    <div class="col-6">
                        <label class="control-label">Confirm Password</label>
                        <input class="input--style-4 form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="Confirm Password">
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
              Have an account?  <a href="{{url('/')}}/login?id={{ @$dId }}">Sign In</a>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- /Contact-us-->
<!-- /Error-404-->

<!--Brands-->
@include('pages.front.brand')
<!-- /Brands-->
<br>
<br>
<br>
<br>
<section class="about flex-box" style="background-color:#8c9090;text-align:center;color:wheat">
    <div class="container" style="">
      <div style="margin-top:15px">
        <span>FOLLOW US</span>
      </div>
      <div style="font-size:xx-large">
        <a href="https://www.linkedin.com/company/reandabernardi/" style="color:wheat"><span class="fa fa-linkedin"></span></a>
      </div>
    </div>
  </section>


@endsection

<?php /*
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
*/ ?>

@push('styles')

<!-- Vendor CSS-->
<link href="{{ asset('assets/register/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('assets/register/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

<style type="text/css">
    .radio-container {
  display: inline-block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  font-size: 16px;
  color: #666;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.radio-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.radio-container input:checked ~ .checkmark {
  background-color: #e5e5e5;
}

.radio-container input:checked ~ .checkmark:after {
  display: block;
}

.radio-container .checkmark:after {
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 12px;
  height: 12px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  background: #57b846;
}

.checkmark {
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #e5e5e5;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}
</style>

@endpush

@push('scripts')

<!-- Jquery JS-->
<script src="{{ asset('assets/register/vendor/jquery/jquery.min.js') }}"></script>
<!-- Vendor JS-->
<script src="{{ asset('assets/register/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/register/vendor/datepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/register/vendor/datepicker/daterangepicker.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('assets/register/js/global.js') }}"></script>

@endpush
