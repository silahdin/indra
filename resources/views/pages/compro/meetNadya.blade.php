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
                ASDASDASD
                <p>
                    <i><strong>@lang('main.meetnadya_title1')</strong></i><br>
                    @lang('main.meetnadya_title2')
                </p>
                <p>
                    <i><strong>@lang('main.meetnadya_title3')</strong></i>
                    <br>
                    @lang('main.meetnadya_title4')
                </p>
                <p>
                    <i><strong>@lang('main.meetnadya_title5')</strong></i>
                    <br>
                    @lang('main.meetnadya_title6')
                </p>
                <p>
                    <i><strong>@lang('main.meetnadya_title7')</strong></i>
                    <br>
                    @lang('main.meetnadya_title8')
                </p>
                <p>
                    <i><strong>@lang('main.meetnadya_title9')</strong></i>
                    <br>
                    @lang('main.meetnadya_title10')
                </p>
                <?php /*<p>I graduated from Brawijaya University, majoring in Accounting with a specialization in taxation. I am assigned a number of tax compliance clients of which I do monthly tax computations/review, payment and reporting. Also, I am also involved in preparation of documents related to tax audits and appeals for major national and international clients. </p>
                <p>I am eager to develop my knowledge and skills in taxation. I experience that the leadership team in RB is very committed in developing their people. Every day is always an exciting day for me to gain new experiences. </p>
                <p>I was selected to join a team that handled the incorporation of a permanent establishment, monthly and annual tax compliance, up to their dissolution. This client is a global event organizer that handled the opening ceremony of Asian Games 2018. I was beyond excited to get a special access during the rehearsal and the Game, and got a chance to work with their team in serving Indonesia’s remarkable event. </p>*/ ?>
                <!-- <h5 class="sub-meet-us"></h5> -->
                <h6 class="sub-meet-us"><strong> Nadya Aurora Pratiwi</strong> - @lang('main.meetnadya_tax_consultant')</h6>

            </div>
            <div class="col-sm-3">
                <div class="wrap-meet">
                    <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/girl.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
