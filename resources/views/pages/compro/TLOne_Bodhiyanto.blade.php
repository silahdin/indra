@extends('layouts.appcompro')

@section('content')


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/about.jpg');
?>

<div class="space-top"></div>

	<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>Thought Leader</h1>
			<p>At Reanda Bernardi, we help organizations solving their problems and scaling up their businesses. We focuses on audit and assurance, tax, merger and acquisition, and advisory.
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
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/bodhiyanto.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>BODHIYANTO ANGWYN</h2>
					<h5>Tax Leader of Reanda Bernardi, Batam Office</h5>
					<p>Bodhi is leading the Tax Line of Service of Reanda Bernardi in Batam, carried under PT Moores Rowland Consulting (”MRC”). Bodhi was one of the founders of MRC, now is a market leader in providing tax consulting services in Batam, a free-trade zone that has special tax treatments.</p>
					<p>Prior to leading MRC, Bodhi brought in more than 25 years of professional experience in taxation. He led Batam branch of Big Four Indonesia for five years prior to establishing MRC in the late 1998.</p>
					<p>Bodhi, having attended international tax conferences in Singapore, Sydney, Toronto, Rio De Janeiro, Amsterdam, Beijing, London, and Thailand, has a deep exposure in international taxation. He has been providing tax consulting and tax compliance services to multinational firms in Batam, which mostly were established as a manufacturing arm of their Singapore parent company, aiming to make use of special VAT-free treatment in Batam.</p>
					<p>Sharing the vision of Reanda Bernardi to be a catalyst to human capital development in Indonesia, Bodhi has continuously worked together with Batam tax authority in socializing tax updates and new tax regulations to business community.</p>
					<p>Bodhy’s area of expertise includes corporate tax planning and compliance, personal tax compliance, international tax planning, mergers and acquisitions, transfer pricing and tax audit and tax court appeals. He has worked collaboratively with Tio in contributing articles for PRISM.</p>
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
							<li>BA, Accounting &ndash; Trisakti University</li>
							<li>Indonesian Certified Tax Consultant &ndash; Brevet C</li>
						</ul>
								
					</section>

					<section id="content2" class="single-content">
						<ul>
							<li>Corporate tax compliance and planning</li>
							<li>Personal tax compliance</li>
							<li>International tax planning</li>
							<li>Mergers and acquisitions</li>
							<li>Transfer pricing and investigations</li>
							<li>Tax audit and tax court appeaals</li>
						</ul>
					</section>

					<section id="content3" class="single-content">
						<ul>
							<li>Manufacturing</li>
							<li>Technological</li>
							<li>Pharmaceutical</li>
							<li>Healthcare</li>
							<li>Financial Services</li>
						</ul>						
					</section>

					<section id="content4" class="single-content">
						<ul>
							<li>Indonesian Institute of Tax Consultants, Member</li>
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
