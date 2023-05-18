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
        <h3>@lang('main.services_list_login')</h3><br>
        <div class="contact_form gray-bg">
          <form method="POST" action="{{ route('login') }}">
            <?php 
              if(Input::has('id')){
                  $dId = Input::get('id');
              } else {
                  $dId = 0;
              }
            ?>
            <input type="hidden" name="idjob" value="{{$dId}}">
            @csrf
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label class="control-label">@lang('main.karir_email') <span></span></label>
                  <input id="lemail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} white_bg" name="email" value="{{ old('email') }}" required autofocus placeholder="Please enter your Email">
                  @if ($errors->has('email'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label class="control-label">@lang('main.password') <span></span></label>
                  <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} white_bg" name="password" required placeholder="Please enter your Password">

                  @if ($errors->has('password'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-6" style="margin-top: 10px;">
                  <p style="margin-bottom: 20px;">
                    <button id="btn-reload-captcha" type="button" class="btn btn-sm btn-primary" style="height: 100%; margin-right: 10px;">
                      <i class="fa fa-refresh"></i>
                    </button> 
                    <span id="captcha_content">{!! captcha_img('flat') !!}</span>
                  </p>
                  <input class="form-control {{ $errors->has('captcha') ? ($errors->has('email') ? '' : 'is-invalid') : '' }}" type="text" name="captcha" placeholder="Please fill captcha above" required>

                  @if ($errors->has('captcha'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('captcha') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group checkbox" style="margin-bottom: 10px;">
                <input type="checkbox"  id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} style="margin-left: 0;">
                <label for="remember">@lang('main.remember')</label>
            </div>

            <div class="form-group">
              Not a member? 
              <a href="{{url('/')}}/register?id={{ @$dId }}">
                Sign up now             
              </a>
            </div>


            <div class="form-group">
              <a href="{{ url('password/reset') }}">
              Forgot Password?            
            </a>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                  @lang('main.services_list_login')
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

@push('scripts')

<script type="text/javascript">
  
  $(document).ready(function () {
      $('#btn-reload-captcha').click(function(){

        let r = Math.random().toString(36).substring(2, 10);

        $('#captcha_content').html('<img src="{{ env('APP_URL') }}/captcha/flat?'+r+'">');
      })
  });

</script>

@endpush
