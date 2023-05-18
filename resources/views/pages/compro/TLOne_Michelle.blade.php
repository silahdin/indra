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
					<img class="img-tl-res-dif" src="{{asset('assets/compro/assets/frontend_assets/images/about/ms_bernardi.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>MICHELLE BERNARDI </h2>
					<h5>CEO of Reanda Bernardi, Jakarta </h5>
					<p>Embracing the philosophy of independence, Michelle, a distinguished young woman from a respectable professional
					business family, has taken the formerly traditional accounting firm, Drs Bernardi & Co, to the next level,
					becoming a one-stop internationally-recognized professional service firm. Through Michelle’s innovation,
					leadership and entrepreneurial spirit, Reanda Bernardi successfully diversified its service portfolio to include
					tax, business advisory, corporate finance and management consulting.</p>
					<p>Prior to leading Reanda Bernardi, Michelle had extensive audit, M&A and business advisory experience in Big Four Indonesia and several major consulting firms in the USA and Canada. Enhanced by her vast experience and solid academic background, Michelle has been leading projects in the area of financial audits, business advisory, international taxation, financial and tax due diligence, internal audits, business process improvements, financial modeling and sensitivity analysis, business valuation, capital raising, international equity portfolio development, market and benchmarking analysis, and business plan development.</p>
					<p>Michelle has envisioned Reanda Bernardi not only as a sustainable business, but also as a catalyst to human capital development in Indonesia. Towards this end, she has been actively involved in the development of public accounting profession and finance and accounting professions at large. She has continuously served the Indonesian finance and accounting community as a speaker and moderator at national and international events, including serving the financial authorities.</p>
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
									<li>BA, Accounting &ndash; University of Indonesia</li>
									<li>MBA, Finance &ndash; University of Illinois at Urbana &ndash; Champaign</li>
									<li>Indonesian Certified Public Accountant</li>
									<li>Indonesian Certified Tax Consultant &ndash; Brevet C</li>
									<li>CFA Candidate Level 2</li>
									<li>Trustee in bankruptcy</li>
                                    <li>Tax court attorney</li>

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
									<li>Editorial board of CPA   magazine, 2015 – 2018</li>
                                    <li>Forum of CPA firms, Indonesian Institute of Certified Public Accountants, 2018 – present.</li>

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
