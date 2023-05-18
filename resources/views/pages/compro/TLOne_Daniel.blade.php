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
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/Daniel.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>DANIEL LIU<h2>
					<h5>China Desk, Batam </h5>
					<p>Embracing the philosophy of independence, Michelle, a distinguished young woman from a respectable professional
						business family, has taken the formerly traditional accounting firm, Drs Bernardi & Co, to the next level,
						becoming a one-stop internationally-recognized professional service firm. Through Michelle’s innovation,
						leadership and entrepreneurial spirit, Reanda Bernardi successfully diversified its service portfolio to include
						tax, business advisory, corporate finance and management consulting.</p>
					<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus magni dicta accusantium odio beatae
						ducimus, doloribus, autem aliquam excepturi magnam odit et eum molestias libero iure. Quae porro exercitationem
						molestias minima fugiat voluptate, sint voluptas repellendus molestiae nesciunt optio! Soluta, aspernatur quas
						necessitatibus temporibus unde libero amet eius et. Voluptate, qui officia necessitatibus libero repudiandae odio
						eaque sit eum commodi doloremque rerum iste praesentium blanditiis quod delectus quia aut provident quae nostrum
						soluta labore tenetur natus? Aliquid nam fugit quos ad modi unde a. Dolores unde molestiae, est nemo sequi,
						cumque aliquam porro sit natus consequatur nostrum sint earum fugiat, officia voluptates odio totam itaque atque
						quasi ipsum minima aperiam blanditiis. Ut, dicta iste rem sit cum eligendi facilis assumenda accusantium sed!
						Blanditiis quidem ipsum, consectetur dicta expedita debitis vel eaque similique ducimus eligendi delectus?
						Distinctio alias nemo, atque provident, cupiditate ea illo, a iste tenetur iusto neque! At corrupti reprehenderit
						explicabo fugit dignissimos nisi eos ut alias odit. Rem dolor quae itaque voluptate, asperiores nulla cumque
						atque provident? Facere libero incidunt tenetur distinctio delectus porro, fuga sit officia aspernatur, nemo
						quidem maxime repellendus neque labore. Quasi blanditiis accusantium, alias illum, veniam, quo quia sit facilis
						natus magnam amet omnis.</p>
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
					<label for="tab2">Areas of Expertises</label>

					<input id="tab3" type="radio" name="tabs">
					<label for="tab3">Industries</label>

					<input id="tab4" type="radio" name="tabs">
					<label for="tab4">Professional Societies</label>

					<section id="content1" class="single-content">
							<ul>
									<li>BA, Accounting &ndash; University of Indonesia</li>
									<li>MBA, Finance &ndash; University of Illinois at Urbana &ndash; Champaign</li>
									<li>Indonesian Certified Public Accountant</li>
									<li>Indonesian Certified Tax Consultant &ndash; Brevet C</li>
									<li>CFA Candidate Level 2</li>
								</ul>
								
					</section>

					<section id="content2" class="single-content">
							<ul>
									<li>General Audit</li>
									<li>Internal Audit</li>
									<li>International Tax Planning</li>
									<li>Profit Improvement</li>
									<li>Business Process Improvement</li>
									<li>Corporate Finance</li>
									<li>M&amp;A</li>
								</ul>
								
					</section>

					<section id="content3" class="single-content">
							<ul>
									<li>Energy and Mining</li>
									<li>Manufacturing</li>
									<li>Plantation</li>
									<li>Pharmaceutical</li>
									<li>Healthcare</li>
									<li>Financial Services</li>
								</ul>
					</section>

					<section id="content4" class="single-content">
							<ul>
									<li>IFRS Implementation Team, Indonesian Institute of Accountants , 2009-2012</li>
									<li>Professional education and learning committee, Indonesian Institute of CPA, 2013-2017</li>
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
