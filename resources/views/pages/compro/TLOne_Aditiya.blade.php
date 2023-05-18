@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/about.jpg');
?>

<div class="space-top"></div>

	<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.tlone_leader')</h1>
			<p>@lang('main.tlone_leader_detail')</p>

			<p>@lang('main.tlone_leader_profile')
				<span style="position:hidden">
					<span id="profileLeader"></span>
				</span>
			</p>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-3">
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Aditiya.png')}}" alt="">
					<!-- <img src="./assets/compro/images/about/Aditiya.png" alt=""> -->
				</div>
				<div class="col-sm-9">
					<h2>ADITIYA FEBRIANSYAH </h2>
					<h5>@lang('main.tlone_header')</h5>
					<p>@lang('main.tlone_des1')</p>
					<p>@lang('main.tlone_des2')</p>
					<p>@lang('main.tlone_des3')</p>
					<p>@lang('main.tlone_des4')</p>
				</div>
			</div>
			<br>


		</div>
	</section>

	<section class="person-leader-tab">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-12">
					<input id="tab1" type="radio" name="tabs" checked>
					<label for="tab1">Educations & Certifications</label>

					<input id="tab2" type="radio" name="tabs">
					<label for="tab2">Areas of Expertise</label>

					<input id="tab3" type="radio" name="tabs">
					<label for="tab3">Industries</label>

					<input id="tab4" type="radio" name="tabs">
					<label for="tab4">Professional Societies</label>

					<section id="content1" class="single-content">
							<ul>
									<li>BA, Accounting – Brawijaya University</li>
                  <li>BA, Law – Pamulang University</li>
                  <li>Indonesian Certified Tax Consultant – Brevet C</li>
                  <li>Tax Court Attorney</li>
							</ul>

					</section>

					<section id="content2" class="single-content">
							<ul>
									<li>Corporate tax compliance and planning</li>
                  <li>Personal tax compliance</li>
                  <li>International tax planning</li>
                  <li>Mergers and acquisitions</li>
                  <li>Transfer pricing </li>
                  <li>Tax investigations</li>
                  <li>Tax audit, tax objection, and tax court appeals </li>
							</ul>

					</section>

					<section id="content3" class="single-content">
							<ul>
									<li>Oil and gas</li>
                  <li>Consumer products</li>
                  <li>Manufacturing</li>
                  <li>Trading</li>
                  <li>Services</li>
                  <li>Telecommunication</li>
                  <li>Plantation</li>
                  <li>Hospitality</li>
                  <li>Leasing</li>
							</ul>
					</section>

					<section id="content4" class="single-content">
							<ul>
									<li>Indonesian Institute of Tax Consultants, Member</li>
                  <li>Indonesian Institute of Accountants – Tax Compartment, Member</li>
							</ul>

					</section>
					<hr>

				</div>
			</div>
		</div>
	</section>

<br>
<br>


@endsection
