@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Banner Page Audit & Assurance.jpg');
?>
<div class="space-top">
</div>

<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
    <div class="boxes">
        <h1>@lang('main.meet_people')</h1>
    </div>
</section>
<br>
<br>
<section class="services-page person-leader detail-leader">
    <div class="container container-content">
        <div class="row">
            <div class="col-sm-12">
                <p>@lang('main.meet_detail1')</p>
                <p>@lang('main.meet_detail2')</p>
                <p>@lang('main.meet_detail3')</p>
                <ul>
                    <li>@lang('main.meet_list1')</li>
                    <li>@lang('main.meet_list2')</li>
                    <li>@lang('main.meet_list3')</li>
                    <li>@lang('main.meet_list4')</li>
                    <li>@lang('main.meet_list5')</li>
                </ul>
                <br>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="box-people">
                    <div class="wrap-img">
                        <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/girl.jpg')}}" alt="">
                    </div>
                    <br>
                    <strong>Evilia Insly</strong>
                    <p>Heroku Developer</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box-people">
                    <div class="wrap-img">
                        <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/girl.jpg')}}" alt="">
                    </div>
                    <br>
                    <strong>Evilia Insly</strong>
                    <p>Heroku Developer</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box-people">
                    <div class="wrap-img">
                        <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/girl.jpg')}}" alt="">
                    </div>
                    <br>
                    <strong>Evilia Insly</strong>
                    <p>Heroku Developer</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box-people">
                    <div class="wrap-img">
                        <img src="{{asset('assets/compro/assets/frontend_assets/images/etc/girl.jpg')}}" alt="">
                    </div>
                    <br>
                    <strong>Evilia Insly</strong>
                    <p>Heroku Developer</p>
                </div>
            </div>

        </div>
    </div>
</section>

<br>


	<br>
	<br>
    @include('pages.compro.follow')

@endsection
