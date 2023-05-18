@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/about.jpg');
?>

<div class="space-top"></div>

<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
	<div class="boxes">
		<h1>Thought Leader</h1>
		<p>At Reanda Bernardi, we help organizations solving their problems and scaling up their businesses. We focuses
			on audit and assurance, tax, merger and acquisition, and advisory.
		</p>

		<p>Your goals are our goals. Let’s work together in seizing the opportunities in Indonesia’s burgeoning economy.
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
				<img  class="img-tl-res-dif" src="{{asset('assets/compro/assets/frontend_assets/images/about/Michiyo.png')}}" alt="">
			</div>
			<div class="col-sm-9">
				<h2>MICHIYO OKUBO</h2>
				<h5>Japan Desk Partner, Jakarta Office</h5>
				<p>Michiyo is in-charge for running Japan Desk in Reanda Bernardi. She is also the Managing Director of MIRAI Consulting Malaysia. 
				MIRAI Consulting Malaysia is part of the large consulting group in Japan, MIRAI Consulting Inc. </p>
				<p>Prior to joining MIRAI Consulting, Michi was the representative in Indonesian 
				subsidiary of a Japanese accounting firm for a number of years. 
				She is therefore well-versed in tax and business landscape in Indonesia.</p>
				<p>Michi has been serving clients in the area of internal audit and taxation. One of her notable projects was 
				the United Nations mission in East Timor of which she was the consultant in governmental internal audit team.</p>
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
					    <li>Certified Public Tax Accountant in Japan</li>
					</ul>

				</section>

				<section id="content2" class="single-content">
					<ul>
						<li>Internal audit</li>
                        <li>Corporate tax compliance and planning</li>
                        <li>Personal tax compliance</li>
                        <li>International tax planning</li>
                        <li>Mergers and acquisitions</li>
                        <li>Transfer pricing</li>
                        <li>Tax investigations</li>
                        <li>Tax audit, tax objection, and tax court appeals</li>

					</ul>

				</section>

				<section id="content3" class="single-content">
					<ul>	
					    <li>Consumer products</li>
                        <li>Manufacturing</li>
                        <li>Trading</li>
                        <li>Services</li>
                        <li>Hospitality</li>
                        <li>NGO</li>
                        
					</ul>
				</section>
				<section id="content4" class="single-content">
					<ul>
						<li>Japan Federation of Certified Public Tax Accountants’ Associations</li>
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