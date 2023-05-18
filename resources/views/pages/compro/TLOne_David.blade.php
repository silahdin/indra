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
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/David.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>DAVID BATARA</h2>
					<h5>Audit and Assurance Partner of Reanda Bernardi, Batam Office</h5>
					<p>David joined Reanda Bernardi from a senior associate level with combined seven years of public accounting and 
					corporate accounting experiences. Within six years, he quickly moved his career up to Partner level. 
					David leads the audit and assurance services of Reanda Bernardi at Batam branch office.</p>
					<p>Prior to leading Batam operations, David led multiple audit and advisory engagements of local 
					and multinational clients in Jakarta office. In Batam office, he handles Indonesian subsidiaries of global companies 
					and have been working extensively under a group audit setting</p>
					<p>David’s area of expertise includes general audit, financial due diligence, book-keeping advisory, IFRS advisory, 
					and development of standard operating procedures. His corporate accounting experiences have provided a comprehensive view 
					as he provides assurance and advisory services to clients. </p>
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
									<li>BA, Accounting – STEI</li>
                                    <li>Certified Accountant (Ak) – University of Indonesia</li>
                                    <li>Indonesian Certified Public Accountant</li>
								</ul>
								
					</section>

					<section id="content2" class="single-content">
							<ul>
									<li>General audit</li>
                                    <li>Financial due diligence</li>
                                    <li>Book-keeping advisory</li>
                                    <li>IFRS advisory</li>
                                    <li>SOP development	</li>
								</ul>
								
					</section>

					<section id="content3" class="single-content">
							<ul>
									<li>Oil and gas</li>
                                    <li>Financial services</li>
                                    <li>Consumer products</li>
                                    <li>Manufacturing</li>
                                    <li>Trading</li>
                                    <li>Services</li>
                                    <li>Construction</li>
                                    <li>NGO</li>
								</ul>
					</section>

					<section id="content4" class="single-content">
							<ul>
							        <li>Indonesian Certified Public Accountants, Member</li>
                                    <li>Indonesian Institute of Accountants, Member</li>

									
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
