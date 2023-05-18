@extends('layouts.appcompro')

@section('content')

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
        <h3>{{ __('Reset Password') }}</h3>
        <br>
        <div class="contact_form gray-bg">
          
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="control-label">Email Address</span></label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Please enter your Email Address">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if(@\Session::get('info') ?? 0 == 1)
                    <div class="form-group" style="color: #066360;">
                      Link has been sent, please check your email
                    </div>
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
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
