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
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/MarkBernardi.jpg')}}" alt="">
					<!-- <img src="./assets/compro/images/about/Aditiya.png" alt=""> -->
				</div>
				<div class="col-sm-9">
					<h2>MARK BERNARDI, BSC</h2>
					<h5>IT & Business Establishment Consultant</h5>
					<p>Mark Bernardi is a passionate IT practitioner. He earned his bachelor degree in Computer Science from Georgia Institute of Technology. 
					He has considerable hands-on experiences in the telecommunication and banking industries in Indonesia.</p>
					<p>During his years with Citi Group, he led several big migration projects such as credit cards, collection system migration and national clearing system. 
					He also served as the country’s subject-matter expert for Credit Approval System for Assets Products and Front-liner application for online Portfolio actions.</p>
					<p>At Reanda Bernardi, Mark spearheads the IT initiatives among the community members. We believe that technological-led innovation would create a competitive advantage to any business. 
					He also heads the IPHub, Virtual Office and Business Establishment Consulting, a sister company of Reanda Bernardi.</p>
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
									<li>Bachelor of Science, Computer Science - Georgia Institute of Technology</li>
                                    <li>Software Engineering & Databases</li>
								</ul>
								
					</section>

					<section id="content2" class="single-content">
							<ul>
									<li>IT Project Management & Business Analysis</li>
                                    <li>Business Software Development</li>
                                    <li>Business Management & Consulting</li>
                                    <li>Business Establishment</li>
                                    <li>Startup Growth and its Ecosystem</li>

								</ul>
								
					</section>

					<section id="content3" class="single-content">
							<ul>
									<li>Telecommunication</li>
                                    <li>Banking</li>
                                    <li>Financial Technology</li>
                                    <li>Property Management</li>
                                    <li>Food and Beverages</li>

								</ul>
					</section>

					<section id="content4" class="single-content">
							<ul>
									<li>-</li>
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
