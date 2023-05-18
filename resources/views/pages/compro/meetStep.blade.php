@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Banner Page Audit & Assurance.jpg');
?>
<div class="space-top">
</div>
<section class="services-page person-leader detail-leader">
    <div class="container container-content">
        <div class="row">
            <div class="col-sm-9">
                <p>
                    <i><strong>@lang('main.meetstep_title1')</strong></i>
                    <br>
                    @lang('main.meetstep_title2')
                </p>
                <p>
                    <i><strong>@lang('main.meetstep_title3')</strong></i>
                    <br>
                    @lang('main.meetstep_title4')
                </p>
                <p>
                    <i><strong>@lang('main.meetstep_title5')</strong></i>
                    <br>
                    @lang('main.meetstep_title6')
                </p>
                <p>
                    <i><strong>@lang('main.meetstep_title7')</strong></i>
                    <br>
                    @lang('main.meetstep_title8')
                </p>
                <p>
                    <i><strong>@lang('main.meetstep_title9')</strong></i>
                    <br>
                    @lang('main.meetstep_title10')
                </p>
                <?php /*<p>Indonesian Citizen, lives in Jakarta. I received diploma in Financial Accounting from Universitas Indonesia and Bachelor in Universitas Trisakti. When joined KAP Bernardi, I was assigned over exploration, exploitation and commerce client industries. I was challenged to implement several accounting best practices over new issuance of accounting standards. The experience that I had was amazing, by having rigorous learning over accounting technicals and collaborating with the team has bring success over the engagements and clients as well.</p>
                <p>Currently, in KAP Bernardi I have lead 14 over multiple engagements as senior incharge . Being part of KAP Bernardi, we have put our shoe in each other, share and collaborate to bring success together.</p>*/ ?>
                <h6 class="sub-meet-us"><strong> Stephanie Octavia</strong> - @lang('main.meetstep_senior_associate')</h6>
            </div>
            <div class="col-sm-3">
                <div class="wrap-meet">
                    <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/gr.jpg')}}" alt="">

                </div>
            </div>
        </div>
    </div>
</section>


	<br>
	<br>
    @include('pages.compro.follow')
@endsection
