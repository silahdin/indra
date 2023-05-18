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
                    <i><strong>@lang('main.meetadit_title1')</strong></i>
                    <br>
                      @lang('main.meetadit_title2')
                </p>
                <p>
                    <i><strong>@lang('main.meetadit_title3')</strong></i>
                    <br>
                    @lang('main.meetadit_title4')
                </p>
                <p>
                    <i><strong>@lang('main.meetadit_title5')</strong></i>
                    <br>
                    @lang('main.meetadit_title6')
                </p>
                <?php /*
                <p>I joined the Reanda Bernardi on 2012 as Tax Director. I decided to join with Reanda Bernardi, which firm has over 50’s years’ experience in Indonesia, because I think the Company experience could give more advantage to my CV, and the intrigue if the experience I had could provide huge leverage to the Company contribution in the market. As Tax Director, I have responsibility not only to handle the client’s tax matters but also the happiness and adventurous environment of my team.</p>
                <p>Based on my 15 years’ experience in Indonesian tax field as well as working in one of big four firm and in the multinational company, Reanda Bernardi is the great place to feel at home when you’re work, and the environment meet with the millennial expectation. </p>
                <p>Note for you, who seeks the great place for work which can provide you with the experience in handling multinational and international clients, fun-happy-and adventurous environment team, feels like home and gain/achieve mutual success, be the part of Reanda Bernardi. </p>*/ ?>
                <h6 class="sub-meet-us"><strong> Aditiya Febriansyah</strong> - @lang('main.meet_tax_director')</h6>

            </div>
            <div class="col-sm-3">
                <div class="wrap-meet">
                    <img src="{{asset('assets/compro/assets/frontend_assets/images/about/Aditiya.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
