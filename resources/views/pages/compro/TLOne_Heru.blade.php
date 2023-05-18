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
					<img class="img-tl-res-dif"  src="{{asset('assets/compro/assets/frontend_assets/images/about/heru.png')}}" alt="">
				</div>
				<div class="col-sm-9">
					<h2>HERU PRASETYO </h2>
					<h5>Lead Tax Partner, Jakarta</h5>
					<p>Bringing in his ten years of experience with Big Four Indonesia and four years of experience in a leading Indonesian TV broadcast media and telecommunication, Tio is leading the Tax Line of Services of Reanda Bernardi, carried under a legal entity of PT Tridaya Partners. He serves clients in Jakarta, Surabaya and other big cities in Indonesia.
					</p>
					<p>Tio has been providing tax consulting and tax compliance services to a wide range of multinational and local companies in a variety of industries, as well as high-profile individuals and expatriates.</p>
					<p>Tio has deep experience in handling full range of Indonesian tax issues, including corporate taxes, value added taxes, withholding taxes, personnel taxes, international tax planning and taxation in merger & acquisition deals.</p>
					<p>Tio is well versed in delivering tax diagnostic reviews to ensure proper tax compliance and to assess tax exposures. He also provides assistance during tax audits, from tax objection to tax appeal. He stands out in seeking specific tax rulings from tax authorities and in dealing with judicial review to the Supreme Court.</p>
					<p>Furthermore, Tio has extensive experiences in due diligence reviews of merger and acquisition deals, tax dispute resolution and tax court proceedings. Tio represents Reanda Indonesia in the International Tax Panel of Reanda International. He contributes his insights on different aspects of taxation in Indonesia in PRISM, a quarterly-issued Reanda International tax newsletter, which provides updates about the recent taxation changes and current hot topics in various countries where Reanda Network has presence.</p>
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
							<li>Indonesian Certified Tax Consultant &ndash; Brevet C</li>
							<li>Tax court attorney</li>
						</ul>	
					</section>

					<section id="content2" class="single-content">
						<ul>
							<li>Corporate Tax Compliance and Planning</li>
							<li>Personal Tax Compliance</li>
							<li>International Tax Planning</li>
							<li>Mergers and Acquisitions</li>
							<li>Transfer Pricing</li>
							<li>Tax Investigations</li>
							<li>Tax Audit, Tax Objection, and Tax Court Appeals</li>
						</ul>
					</section>

					<section id="content3" class="single-content">
						<ul>
							<li>Consumer Products</li>
							<li>Manufacturing</li>
							<li>Trading</li>
							<li>Services</li>
							<li>Telecommunication</li>
							<li>Natural Resources</li>
							<li>Nutrition &amp; Pharmaceutical</li>
							<li>TV Broadcast Media</li>
							<li>Advertisement Agency</li>
						</ul>
					</section>

					<section id="content4" class="single-content">
						<ul>
							<li>Indonesian Institute of Tax Consultants, Member</li>
							<li>Indonesian Institute of Accountants, Tax Compartment</li>
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
