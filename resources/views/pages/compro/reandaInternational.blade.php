@extends('layouts.appcompro')

@section('content')


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/international.jpg');
?>
<style>
		.modal-lg {
			max-width: 50% !important;
	}
</style>
<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.newreanda_internation')</h1>
			<p>@lang('main.newreanda_internation_title')</p>
			<p>@lang('main.newreanda_internation_subtitle')</p>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-12">
					<h2>@lang('main.newreanda_firm_profile')</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<p>
						@lang('main.newreanda_title1')
					</p>
					<p>
						@lang('main.newreanda_title2')
					</p>
					<p>
						@lang('main.newreanda_title3')
					</p>
					<p>
						@lang('main.newreanda_title4')
					</p>
					<br>
					<br>
				</div>
				<div class="col-sm-3">
					<img class="img-dl-rl" src="{{asset('assets/compro/assets/frontend_assets/images/etc/dl.jpg')}}" alt="">
					<div class="wrapper-btn">
						<a href="{{asset('assets/compro/assets/frontend_assets/doc/etc/Reandabernardi-Compro-2018_FINAL.pdf')}}">@lang('main.newreanda_download_company')</a>
					</div>
					<div class="wrapper-btn">
						<a href="{{asset('assets/compro/assets/frontend_assets/doc/etc/ReandachinafinalPreview.pdf')}}">@lang('main.newreanda_download_company_chinese')</a>
					</div>
				</div>
			</div>
			<br>

			<hr>

			<div class="row">
				<div class="col-12"><h2>@lang('main.newreanda_directory')</h2></div>
				<br><br><br>
				<div class="col-3">
				  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: white">
					<a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">AFRICA</a>
					<a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">ASIA</a>
					<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">EUROPE</a>
					<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">MIDDLE EAST</a>
					<a class="nav-link" id="v-pills-test-tab" data-toggle="pill" href="#v-pills-test" role="tab" aria-controls="v-pills-settings" aria-selected="false">OCEANIA</a>

				  </div>
				</div>
				<div class="col-9">
				  <div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
						<ul>
							<li><a href="#" data-toggle="modal" data-target="#MauritiusModal">Mauritius</a></li>
							<li><a href="#" data-toggle="modal" data-target="#MadagascarModal">Madagascar</a></li>
							<li><a href="#" data-toggle="modal" data-target="#EgyptModal">Egypt</a></li>
						</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<ul>
							<li><a href="#" data-toggle="modal" data-target="#ChinaModal">China</a></li>
							<li><a href="#" data-toggle="modal" data-target="#HongKongModal">Hong Kong</a></li>
							<li><a href="#" data-toggle="modal" data-target="#MacauModal">Macau</a></li>
							<li><a href="#" data-toggle="modal" data-target="#JapanModal">Japan</a></li>
							<li><a href="#" data-toggle="modal" data-target="#MalaysiaModal">Malaysia</a></li>
							<li><a href="#" data-toggle="modal" data-target="#CambodiaModal">Cambodia</a></li>
							<li><a href="#" data-toggle="modal" data-target="#SingaporeModal">Singapore</a></li>
							<li><a href="#" data-toggle="modal" data-target="#VietnamModal">Vietnam</a></li>
							<li><a href="#" data-toggle="modal" data-target="#TaiwanModal">Taiwan</a></li>
							<li><a href="#" data-toggle="modal" data-target="#KoreaModal">Korea</a></li>
							<li><a href="#" data-toggle="modal" data-target="#NepalModal">Nepal</a></li>
							<li><a href="#" data-toggle="modal" data-target="#PakistanModal">Pakistan</a></li>
							<li><a href="#" data-toggle="modal" data-target="#IndiaModal">India</a></li>
						</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
						<ul>
							<li><a href="#" data-toggle="modal" data-target="#CyprusModal">Cyprus</a></li>
							<li><a href="#" data-toggle="modal" data-target="#RussiaModal">Russia</a></li>
							<li><a href="#" data-toggle="modal" data-target="#KazakhstanModal">Kazakhstan</a></li>
							<li><a href="#" data-toggle="modal" data-target="#UKModal">UK</a></li>
							<li><a href="#" data-toggle="modal" data-target="#MaltaModal">Malta</a></li>
							<li><a href="#" data-toggle="modal" data-target="#ItalyModal">Italy</a></li>
							<li><a href="#" data-toggle="modal" data-target="#GermanyModal">Germany </a></li>
							<li><a href="#" data-toggle="modal" data-target="#NetherlandsModal">Netherlands</a></li>
							<li><a href="#" data-toggle="modal" data-target="#GreeceModal">Greece </a></li>
							<li><a href="#" data-toggle="modal" data-target="#PortugalModal">Portugal </a></li>
							<li><a href="#" data-toggle="modal" data-target="#RomaniaModal">Romania </a></li>
							<li><a href="#" data-toggle="modal" data-target="#BelarusModal">Belarus </a></li>
						</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<ul>
									<li><a href="#" data-toggle="modal" data-target="#UAEModal">UAE</a></li>
									<li><a href="#" data-toggle="modal" data-target="#TurkeyModal">Turkey</a></li>
								</ul>
					</div>
					<div class="tab-pane fade" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">
							<ul>
									<li><a href="#" data-toggle="modal" data-target="#AustraliaModal">Australia</a></li>
									<li><a href="#" data-toggle="modal" data-target="#NewZealandModal">New Zealand</a></li>
								</ul>
					</div>
				  </div>
				</div>
			  </div>


		</div>
	</section>


<br>
<br>

<!-- Afrika / Mauritius -->
<div class="modal fade" id="MauritiusModal" tabindex="-1" role="dialog" aria-labelledby="MauritiusModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="MauritiusModalLabel">Mauritius</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <div class="row">
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
				<div class="col-sm-6">
						<strong>Mr. Kim Fat Ho Fong, James</strong><br>
						Managing Partner<br>
						Email: eos@intnet.mu<br>
						Tel:     (230) 210 8588<br>
						Mobile: (230) 5258 6389<br>

				</div>
				<div class="col-sm-6">
						<strong>Mr. Kim Fat Ho Fong, James</strong><br>
						Managing Partner<br>
						Email: eos@intnet.mu<br>
						Tel:     (230) 210 8588<br>
						Mobile: (230) 5258 6389<br>

				</div>
				<div class="col-sm-12"><hr></div>
				<div class="col-sm-6">
						<strong>Ms. Li Kim For, Beatrice</strong><br>
						Partner<br>
						Email: eos@intnet.mu<br>
						Tel:     (230) 210 8588<br>
						Mobile: (230) 5252 7839<br>
				</div>
				<div class="col-sm-6">
						<strong>Ms. Li Kim For, Beatrice</strong><br>
						Partner<br>
						Email: eos@intnet.mu<br>
						Tel:     (230) 210 8588<br>
						Mobile: (230) 5252 7839<br>
				</div>
			  </div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>

	  <!-- Afrika / Madagascar -->
	  <div class="modal fade" id="MadagascarModal" tabindex="-1" role="dialog" aria-labelledby="MadagascarModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="MadagascarModalLabel">Madagascar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Jean Patrick Randriamiandrisoa</strong><br>
							  	Partner<br>
								Email: apex.audit@gmail.com<br>
								Tel:    +261 20 22 297 53<br>
								Mobile: +261 34 01 948 68<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Jean Patrick Randriamiandrisoa</strong><br>
							  Partner<br>
								Email: apex.audit@gmail.com<br>
								Tel:    +261 20 22 297 53<br>
								Mobile: +261 34 01 948 68<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Naivomahery Ratsimanetrimanana</strong><br>
							  Partner<br>
								Email: apex.audit@gmail.com<br>
								Tel: +261 20 22 297 53<br>
								Mobile: +261 34 02 415 30<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Naivomahery Ratsimanetrimanana</strong><br>
							  Partner<br>
								Email: apex.audit@gmail.com<br>
								Tel: +261 20 22 297 53<br>
								Mobile: +261 34 02 415 30<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- Afrika / Madagascar -->
	  <div class="modal fade" id="EgyptModal" tabindex="-1" role="dialog" aria-labelledby="EgyptModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="EgyptModalLabel">Egypt</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Abdelrahman safwat Nour El Din</strong><br>
								Managing Director<br>
								Email: a.safwat@safwatmc.com <br>
								Tel: +002 01222461555<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Marwa Ali</strong><br>
							  Executive Officer<br>
								Email: Marwa.Ali@safwatmc.com <br>
								Tel: +20226910072<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / ChinaModal -->
	  <div class="modal fade" id="ChinaModal" tabindex="-1" role="dialog" aria-labelledby="ChinaModal" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ChinaModal">China</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
						<div class="col-sm-12 text-center"><h2><a href="www.reanda.com">www.reanda.com</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Huang Jinhui </strong><br>
							  Chairman<br>
							  Email: jinhui_huang@reanda.com<br>
							  Tel:    (86) 10 8588 6680<br>
							  Mobile: (86) 13 801 011 462<br>
						</div>
						<div class="col-sm-6">
							  <strong>General Enquiry</strong><br>
							  Head Office of Reanda China <br>
							  Email: ho@reanda.com <br>
							  Tel: (86) 10 8588 6680 <br>
					  </div>

						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							<strong><u>For referral enquiries to Reanda China please send to the following person from Reanda International Beijing headquarter for coordination:</u></strong><br>
							  <strong>Ms. Qiu Yaqi </strong><br>
							  Assistant to International Business Coordinator<br>
							  Email: yaqiqiu@reanda-international.com <br>
							  Dir:(86) 10 8588 6680 ext 8326<br>
							  Mobile: (86) 152 9211 6282<br>
						</div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							<strong><u>And copy the following persons in the email:</u></strong><br>
							  <strong>Ms. Jacqueline Zhang </strong><br>
							  Administration Executive<br>
							  Email: jacquelinezhang@reanda-international.com <br>
							  Dir:(86) 10 8588 6680 ext 8303<br>
							  Mobile: (86) 186 0060 7697<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Michelle Zhao </strong><br>
							  International Business Coordinator<br>
							  Email: michellezhao@reanda-international.com<br>
								Mobile: (86) 185 1529 2515<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / HongKongModal -->
	  <div class="modal fade" id="HongKongModal" tabindex="-1" role="dialog" aria-labelledby="HongKongModal" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="HongKongModal">Hong Kong</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.cpalay.com.hk/">www.cpalay.com.hk</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Ellis Au Yeung </strong><br>
							  Director<br>
							  Email: ellisay@hkreanda.com<br>
							  Tel:    (852) 2541 4188<br>
							  Dir:    (852) 2113 1388<br>
							  Mobile: (852) 90966853 (HK)<br>
							(86)13922853259 (China)	<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Ling Ng </strong><br>
							  Secretary to Director<br>
							  Email: lingng@cpalay.com.hk<br>
							  Tel:  (852) 2541 4188<br>
							  Dir:  (852) 3182 2412<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Franklin Lau </strong><br>
							  Director<br>
								Email: franklin@hkreanda.com<br>
								Tel:    (852) 2541 4188<br>
								Dir:    (852) 2113 1378<br>
								Mobile: (852) 9468 4678 (HK)<br>
								(86) 15338154160 (China)<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Francisca Ho </strong><br>
							  Secretary to Director<br>
								Email: francisca@cpalay.com.hk<br>
								Tel:  (852) 2541 4188<br>
								Dir:  (852) 3182 2411<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / MacauModal -->
	  <div class="modal fade" id="MacauModal" tabindex="-1" role="dialog" aria-labelledby="MacauModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="MacauModalLabel">Macau</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.cpalay.com.hk/ ">www.cpalay.com.hk</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Jackson Chan </strong><br>
							  Partner<br>
							  Email: chanjacksn@hotmail.com<br>
							  Tel:  (853) 2856 2288<br>
							  Dir:  (853) 6630 3456<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Jackson Chan </strong><br>
							  Partner<br>
								Email: chanjacksn@hotmail.com<br>
								Tel:    (853) 2856 2288<br>
								Dir:    (853) 6630 3456<br>
								Mobile: (853) 6666 1901<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Ieong KH Alice </strong><br>
							  Partner<br>
								Email: aliceieongkh@hotmail.com <br>
								Tel:    (853) 28562288<br>
								Dir:    (853) 66801307<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="JapanModal" tabindex="-1" role="dialog" aria-labelledby="JapanModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="JapanModalLabel">Japan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://www.miraic.jp/">www.miraic.jp</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Mitsuo Kubo </strong><br>
							  CEO<br>
							  Email: m-kubo@miraic.jp<br>
							  Tel:    (81) 3 6281 9820<br>
							  Mobile: (81) 90 4596 0966<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Mo JianJie </strong><br>
							  International Business Consultant <br>
								E-mail: baku@miraic.jp<br>
								Tel:    (81) 3 6281 9820<br>
								Mobile: (81) 80 3593 0668 (Japan)<br>
								(86) 135 0181 1659 (China)<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Kan Kouka</strong><br>
							  International Business Consultant<br>
								Email：kan@miraic.jp<br>
								Tel：(86) 755 8346 0616 (Shenzhen)<br>
								Mobile：(86) 135 3089 3085<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / MalaysiaModal -->
	  <div class="modal fade" id="MalaysiaModal" tabindex="-1" role="dialog" aria-labelledby="MalaysiaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="MalaysiaModalLabel">Malaysia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://llkg.com.my">llkg.com.my</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Koong Lin Loong</strong><br>
							  Managing Partner<br>
							  Email: llkoong@llkg.com.my<br>
							  Tel:    (60)3 2166 2303<br>
							  Mobile: (60)19 2115303<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Zoe Ser  </strong><br>
							  PA to Managing Partner<br>
								Email: admin@llkg.com.my<br>
								Tel:  (60)3 2166 2303<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Bigi Neoh</strong><br>
							  Partner<br>
								Email: bigi@llkg.com.my<br>
								Tel:  (60)3 2166 2303<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="CambodiaModal" tabindex="-1" role="dialog" aria-labelledby="CambodiaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="CambodiaModalLabel">Cambodia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://llkg.com.my">llkg.com.my</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Ms. Bigi Neoh </strong><br>
							  Partner<br>
							  Email: bigi@llkg.com.my<br>
							  Tel:  (855) 23 991 003<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Zoe Ser </strong><br>
							  PA to Managing Partner<br>
								Email: admin@llkg.com.my<br>
								Tel:  (60)3 2166 2303<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Bigi Neoh </strong><br>
							  Partner<br>
								Email: bigi@llkg.com.my<br>
								Tel:  (855) 23 991 003<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="SingaporeModal" tabindex="-1" role="dialog" aria-labelledby="SingaporeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="SingaporeModalLabel">Singapore</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://reanda-adept.com.sg/">reanda-adept.com.sg</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Yin Kum Choy </strong><br>
							  Managing Director<br>
							  Email: kcyin@reanda-adept.com.sg<br>
							  Tel:    (65) 6323 1613<br>
							  Dir:    (65) 6603 9818<br>
							  Mobile: (65) 9818 0398<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Yin Kum Choy </strong><br>
							  Managing Director<br>
								Email: kcyin@reanda-adept.com.sg <br>
								Tel:    (65) 6323 1613<br>
								Dir:    (65) 6603 9818<br>
								Mobile: (65) 98180398<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Irene Chan</strong><br>
							  Partner<br>
								E-mail: irenechan@reanda-adept.com.sg <br>
								Tel:    (65) 6323 1613<br>
								Mobile: (65) 9674 8133<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="VietnamModal" tabindex="-1" role="dialog" aria-labelledby="VietnamModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="VietnamModalLabel">Vietnam</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.vietvalues.com/">www.vietvalues.com</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Nguyen Thanh Sang </strong><br>
							  Managing Partner <br>
							  Email: thanhsang@vietvalues.com<br>
							  Tel: (84) 8 3 999 00 91 <br>
							  Mobile: (84) 09 1823 3171 <br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Vu Van Hau</strong><br>
							  Director of HCM branch<br>
								Email: vanhau@vietvalues.com<br>
								Tel:       (84) 8 6289 8887 ext. 206<br>
								Mobile:  (84) 9 3823 8369<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="TaiwanModal" tabindex="-1" role="dialog" aria-labelledby="TaiwanModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="TaiwanModalLabel">Taiwan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.mywcpa.com/">www.mywcpa.com</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Ken Wu </strong><br>
							  Managing Partner<br>
							  Email: kenwu@mywcpa.com<br>
							  Tel:    (886) 2 8772 6262 ext.160<br>
							  Mobile: (886) 9 2043 2882<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Sally Liang </strong><br>
							  Senior Manager<br>
								Email: sallyliang@mywcpa.com<br>
								Tel:    (886) 2 8772 6262 ext.168<br>
								Mobile: (886) 9 2043 2880<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Mr. Clint Chiang </strong><br>
							  Partner<br>
								Email: clintchiang@mywcpa.com<br>
								Tel:    (886) 2 8772 6262 ext.165<br>
								Mobile: (886) 9 2674 2868<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="KoreaModal" tabindex="-1" role="dialog" aria-labelledby="KoreaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="KoreaModalLabel">Korea</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.ssac.kr/">www.ssac.kr</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Jungil Choi </strong><br>
							  Tax Partner <br>
							  Email: jichoi@ssac.kr<br>
							  Tel:    +82 2566 8401 <br>
							  Mobile : +82 10 3710 2165 <br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Bomi Kim </strong><br>
							  China Division Manager <br>
								Email : bmkim@ssac.kr<br>
								Tel:    +82 2566 8402 <br>
								Mobile: +82 10 4020 8586 <br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Mr. Soonpil Lee</strong><br>
							  International Division Manager<br>
								Email: splee@ssac.kr<br>
								Tel:    +82-2-566-8402 <br>
								Mobile: +82 10 5321 7088 <br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="NepalModal" tabindex="-1" role="dialog" aria-labelledby="NepalModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="NepalModalLabel">Nepal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://rpbnepal.com">rpbnepal.com</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Bharat Rijal</strong><br>
							  Managing Partner<br>
							  Email: bharat.rijal@rpbnepal.com<br>
							  Tel:    +977 144 3 3221<br>
							  Mobile: +977 98 0105 6269<br>

						</div>
						<div class="col-sm-6">
							  <strong>Mr. Bishnu Prasad Bhandari</strong><br>
							  Partner<br>
								Email: bishnu.bhandari@rpbnepal.com<br>
								Tel:    +977 144 3 3221<br>
								Mobile: +977 98 0210 0555<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Gopal Prasad Pokharel</strong><br>
							  Senior Partner<br>
								Email: gopal.pokharel@rpbnepal.com<br>
								Tel:    +977 144 3 3221<br>
								Mobile: +977 98 0100 1771<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Abhaya Poudel</strong><br>
							  Partner<br>
								Email: abhaya.poudel@rpbnepal.com<br>
								Tel:    +977 1443 3221<br>
								Mobile: +977 98 0115 0915<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / PakistanModal -->
	  <div class="modal fade" id="PakistanModal" tabindex="-1" role="dialog" aria-labelledby="PakistanModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="PakistanModalLabel">Pakistan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Muhammad Haroon</strong><br>
							  Managing Director<br>
							  Email: haroon@hzco.com.pk <br>
							  Tel: +92-21-35674741-44<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Sajid Ali</strong><br>
							  Asst. Manager HR & Administration <br>
								Email: sajid.ali@hzco.com.pk<br>
								Tel: +92 21 35674741-44<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Zakaria</strong><br>
							  Senior Partner<br>
								Email: zakaria@hzco.com.pk <br>
								Tel: +92-21-35674741-44<br>
						</div>
						<div class="col-sm-6"></div>
						<div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Muhammad Yameen </strong><br>
							  Partner<br>
								Email: yameen@hzco.com.pk <br>
								Tel: +92 21 35674741-44<br>
						</div>
						<div class="col-sm-6"></div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="IndiaModal" tabindex="-1" role="dialog" aria-labelledby="IndiaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="IndiaModalLabel">India</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Anil Bhandari </strong><br>
							  Director <br>
							  Email:  anilbhandari@anilashok.com<br>
							  Tel: 91-22-42215300<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. R. Krishnan</strong><br>
							  Partner Anil Ashok & Associates<br>
								Email: krishnan.r@anilashok.com<br>
								Tel:    91-22-42215300<br>
								Dir:    91-22-42215335<br>
								Mobile: 91-9821510596<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Smita Gune</strong><br>
							  Associate Director<br>
								Email: smita.gune@anbglobal.com<br>
								Tel:    91-22-42215300<br>
								Dir:    91-22-42215338<br>
								Mobile: 91-9821134191<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="CyprusModal" tabindex="-1" role="dialog" aria-labelledby="CyprusModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="CyprusModalLabel">Cyprus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="www.reandacyprus.com">www.reandacyprus.com</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Adonis Theocharides</strong><br>
							  Director<br>
								Email:atheocharides@reandacyprus.com<br>
								Tel:   (357) 22 670680<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Ms. Sotia Antoniou</strong><br>
							  Accounting Manager <br>
								Email: santoniou@reandacyprus.com<br>
								Tel:   (357) 22 670680<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Phivos Theocharides</strong><br>
							  Director<br>
								Email:ptheocharides@reandacyprus.com <br>
								Tel:   (357) 22 670680<br>
					  </div>
					  <div class="col-sm-6">
							<strong>Ms. Valentina Achilleos</strong><br>
							Email:vachilleos@reandacyprus.com<br>
							Tel:   (357) 22 670680<br>
					</div>
						<div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Charilaos Hadjiioannou</strong><br>
							  Director<br>
								Email: chadjioannou@reandacyprus.com <br>
								Tel:   (357) 22 670680<br>
						</div>
						<div class="col-sm-6"></div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="RussiaModal" tabindex="-1" role="dialog" aria-labelledby="RussiaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="RussiaModalLabel">Russia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://www.reanda-rusaudit.ru/">www.reanda-rusaudit.ru</a></h2></div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6" style="background-color: #00b9b5; color: white">
								Chief Representative(s)
						</div>
						<div class="col-sm-6" style="background-color: #f26649; color: white">
								Liaison Officers
						</div>
					  <div class="col-sm-6">
							  <strong>Mr. Igor Zhuravlev </strong><br>
							  Managing Partner<br>
								Email: igor@reanda-rusaudit.ru<br>
								Tel:    (7) 916 523 7133<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Igor Zhuravlev</strong><br>
							  Managing Partner<br>
								Email: igor@reanda-rusaudit.ru<br>
								Tel:    (7) 916 5237133<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="KazakhstanModal" tabindex="-1" role="dialog" aria-labelledby="KazakhstanModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="KazakhstanModalLabel">Kazakhstan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mrs. Nurlykyz Alimzhanova </strong><br>
							  Director (Managing Partner)<br>
								Email: alimzhanova@fin-audit.kz<br>
								Tel:　　+ 7 (727) 250-37-20<br>
								Mobile : + 7 701 224 0691<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mrs. Nurlykyz Alimzhanova</strong><br>
							  Director (Managing Partner)<br>
								Email: alimzhanova@fin-audit.kz<br>
								Tel:    + 7 (727) 250-37-20<br>
								Mobile : + 7 701 224 0691<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Mr. Daniyar Nurseitov</strong><br>
							  Deputy Director<br>
								Email:  dan@fin-audit.kz <br>
								Tel:    + 7 (727) 250-37-20<br>
								Mobile: + 7 701 224 0698<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="UKModal" tabindex="-1" role="dialog" aria-labelledby="UKModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="UKModalLabel">UK</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Robert Bean </strong><br>
							  Managing Partner<br>
								Email: robertb@reanda-uk.com<br>
								Tel: +44 208 458 0083<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Robert Bean</strong><br>
							  Managing Partner<br>
								Email: robertb@reanda-uk.com<br>
								Tel: +44 208 458 0083<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Ms. Sarah Dorey</strong><br>
							  Office Manager<br>
								Email: sarahd@grunberg.co.uk<br>
								Tel: +44 208 458 0083<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / MaltaModal -->
	  <div class="modal fade" id="MaltaModal" tabindex="-1" role="dialog" aria-labelledby="MaltaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="MaltaModalLabel">Malta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Robert Borg </strong><br>
							  Managing Partner<br>
							  Email: robert@reandamalta.com <br>
							  Tel: +356 2123 5064<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Michelle Portelli</strong><br>
							  Director<br>
								Email: michelle@reandamalta.com<br>
								Tel: +356 2123 5064<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Robert Theuma</strong><br>
							  Audit Manager<br>
								Email: rtheuma@reandamalta.com <br>
								Tel: +3562123 5064<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / ItalyModal -->
	  <div class="modal fade" id="ItalyModal" tabindex="-1" role="dialog" aria-labelledby="ItalyModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="ItalyModalLabel">Italy</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Dr. Marco Rigobon </strong><br>
							  Partner<br>
								Email: rigobon@studiorbd.pro <br>
								Tel: +39 02 76004040-112/ <br>
								+39 3485838650<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Dr. Alessandro De Luca</strong><br>
							  Partner<br>
								Email: deluca@studiorbd.pro<br>
								Tel: +39 02 76004040-129/ <br>
								+39 3477320329<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Dr. Le Chen</strong><br>
							  Trainee & China Desk<br>
								Email: lechen.studiorbd@gmail.com<br>
								Tel: +39 02 76004040-123/ <br>
								+39 3287062103<br>
						</div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							<strong>Dr. Alessandra Bitetti</strong><br>
							Partner<br>
							Email: bitetti@studiorbd.pro <br>
							Tel: +39 0276004040/ +39 348 512 6864<br>
					</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			<!-- ASIA / GermanyModalLabel -->
	  <div class="modal fade" id="GermanyModal" tabindex="-1" role="dialog" aria-labelledby="GermanyModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="GermanyModalLabel">Germany</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Dr. Robert Lehleiter </strong><br>
							  CEO<br>
								Email: lehleiter@amc-wp.de<br>
								Tel: (49) 7 1329 6814<br>

					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Achim Siegmann</strong><br>
							  CEO<br>
								Email: asiegmann@amc-wp.de<br>
								Tel:    (49) 7 1329 6858<br>
								Mobile: (49) 173 349 3329<br>
					  </div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
					  <div class="col-sm-6">
							  <strong>Mr. Simon Fickert</strong><br>
							  Tax Advisor<br>
								Email: Fickert@lehleiter.de <br>
								Tel: +497132968153<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="NetherlandsModal" tabindex="-1" role="dialog" aria-labelledby="NetherlandsModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="NetherlandsModalLabel">Netherlands</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Gerard A.J. Uijtendaal</strong><br>
							  Partner<br>
								Email: g.uijtendaal@reanda-netherlands.com<br>
								Tel:    +31 20  800 61 90<br>
								Mobile: +31 6 39 77 11 39<br>
					  </div>
					  <div class="col-sm-6">
							  <strong>Mr. Gerard A.J. Uijtendaal</strong><br>
							  Partner<br>
								Email: g.uijtendaal@reanda-netherlands.com<br>
								Tel:    +31 20  800 61 90
								Mobile: +31 6 39 77 11 39<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
							  <strong>Ms. Victoria Salamatina</strong><br>
							  Partner<br>
								Email: v.salamatina@scope-audit.com<br>
								Tel:    +7 495 108 74 93<br>
								Mobile: +7 919  410 48 20<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / Madagascar -->
	  <div class="modal fade" id="GreeceModal" tabindex="-1" role="dialog" aria-labelledby="GreeceModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="GreeceModalLabel">Greece</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. George Athanasiou</strong><br>
							  Partner<br>
								Email: gathanasiou@frt-ike.gr<br>
								Tel:    0030-210-8325958<br>
								Mobile: 0030-6932-663881<br>

						</div>
						<div class="col-sm-6">
							  <strong>Mr. George Athanasiou</strong><br>
							  Partner<br>
								Email: gathanasiou@frt-ike.gr<br>
								Tel:    0030-210-8325958<br>
								Mobile: 0030-6932-663881<br>

						</div>
						<div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Panagiotis Apostolopoulos</strong><br>
							  Partner<br>
								Email: panagiotis.alpha@gmail.com<br>
								Tel:    0030-210-8325958<br>
								Mobile: 0030-6978-909280<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Panagiotis Apostolopoulos</strong><br>
							  Partner<br>
								Email: panagiotis.alpha@gmail.com<br>
								Tel:    0030-210-8325958<br>
								Mobile: 0030-6978-909280<br>
					  </div>
					  <div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. Panos Athanasiou</strong><br>
							  Partner<br>
								Email: pathanasiou@frt-ike.gr; pathanasiou@artiaporeia.gr<br>
								Tel: 0030-211-1825451<br>
								Mobile: 0030-6948749354	<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Panos Athanasiou</strong><br>
							  Partner<br>
								Email: pathanasiou@frt-ike.gr; pathanasiou@artiaporeia.gr<br>
								Tel: 0030-211-1825451<br>
								Mobile: 0030-6948749354	<br>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / PortugalModal -->
	  <div class="modal fade" id="PortugalModal" tabindex="-1" role="dialog" aria-labelledby="PortugalModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="PortugalModalLabel">Portugal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Domingos Cascais</strong><br>
							  Partner<br>
								Email: domingos.cascais@btoc.com.pt <br>
								Tel:    +351 218 045 580<br>
								Mobile: +351 962 804 473<br>

						</div>
						<div class="col-sm-6"></div>
						<div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Pedro Roque</strong><br>
							  Partner<br>
								proque@sroc125.pt <br>
								Tel:     + 351 217 203 300<br>
								Mobile:  + 351 966 821 419<br>
						</div>
						<div class="col-sm-6"></div>
						<div class="col-sm-12"><hr></div>
					  <div class="col-sm-6">
							  <strong>Mr. José Farinha</strong><br>
							  Partner	<br>
								Email: Jose.Farinha@btoc.com.pt 	<br>
								Tel:    +351 218 045 580	<br>
								Mobile: +315 968 017 593	<br>
						</div>
						<div class="col-sm-6"></div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / RomaniaModal -->
	  <div class="modal fade" id="RomaniaModal" tabindex="-1" role="dialog" aria-labelledby="RomaniaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="RomaniaModalLabel">Romania (MoU entered)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-12">
							  <strong>Mr. Victor Papala</strong><br>
							  Partner<br>
								Email: victor.papala@audicont.ro <br>
								Tel: +40 744 373 139<br>

					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / BelarusModal -->
	  <div class="modal fade" id="BelarusModal" tabindex="-1" role="dialog" aria-labelledby="BelarusModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="BelarusModalLabel">Belarus (MoU entered)</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-12">
							  <strong>Ms. Maryia Lemiaza </strong><br>
							  CEO, Managing Partner<br>
								Email: lm@smaroutsourcing.com <br>
								Tel:    +375 17 337 07 37<br>
								Mobile: +375 44 713 11 07<br>

					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / UAEModal -->
	  <div class="modal fade" id="UAEModal" tabindex="-1" role="dialog" aria-labelledby="UAEModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="UAEModalLabel">UAE</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://www.sundubai.net/">www.sundubai.net</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Sunil Jagetiya</strong><br>
							  Chairman and Founder<br>
								Email: sunil@sundubai.net<br>
								Tel:    +971-50-550-7131<br>
								Mobile: +971-55-637-7326<br>
						</div>
						<div class="col-sm-6">
							<strong>Mr. Avinash Jagetiya</strong><br>
							Managing Director<br>
								Email: avinash@sundubai.net<br>
								Tel:    +971-50-550-7131<br>
								Mobile: +971-55-550-7131<br>
						</div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
								<strong>Mr. Mahavir Hingar</strong><br>
								Director – Coporate Finance<br>
								Email: mahavir@sundubai.net<br>
								Tel:    +971-56-430-9781<br>
								Mobile: +971-56-430-9781<br>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / TurkeyModal -->
	  <div class="modal fade" id="TurkeyModal" tabindex="-1" role="dialog" aria-labelledby="TurkeyModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="TurkeyModalLabel">Turkey</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Bora Akgungor</strong><br>
							  Managing Partner<br>
							Email: bora.akgungor@reandaturkey.com <br>
							Tel: +90 532 633 94 70<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Tayfun Zaman</strong><br>
							  Partner<br>
							Email: tayfun.zaman@reandaturkey.com <br>
							Tel: +90 530 766 86 09<br>
						</div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6">
							  <strong>Mr. Mehmetali Demirkaya</strong><br>
							  Partner<br>
							Email:mehmetali.demirkaya@reandaturkey.com <br>
							Tel: +90 532 668 86 70<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Mehmetali Demirkaya</strong><br>
							  Partner<br>
							Email:mehmetali.demirkaya@reandaturkey.com <br>
							Tel: +90 532 668 86 70<br>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / TurkeyModal -->
	  <div class="modal fade" id="AustraliaModal" tabindex="-1" role="dialog" aria-labelledby="AustraliaModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="AustraliaModalLabel">Australia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="http://reanda.com.au">reanda.com.au</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Peter J Polgar</strong><br>
								Executive Chairman – Reanda Australia Pty Ltd<br>
								Email: peterp@reanda.com.au<br>
								Tel:    (61) 2 9999 5611<br>
								Mobile: (61) 414 861 306<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Peter J Polgar</strong><br>
								Executive Chairman – Reanda Australia Pty Ltd<br>
								Email: peterp@reanda.com.au<br>
								Tel:    (61) 2 9999 5611<br>
								Mobile: (61) 414 861 306<br>
						</div>
						<div class="col-sm-12"><hr></div>
						<div class="col-sm-6">
							  <strong>Mr. Edmund So </strong><br>
								Joint Chief Executive Officer(CEO) / Director<br>
								Email: edmunds@reanda.com.au<br>
								Tel:    (61) 2 9999 5611<br>
								Mobile: (61) 409 119 212<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Edmund So </strong><br>
								Joint Chief Executive Officer(CEO) / Director<br>
								Email: edmunds@reanda.com.au<br>
								Tel:    (61) 2 9999 5611<br>
								Mobile: (61) 409 119 212<br>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- ASIA / NewZealandModal -->
	  <div class="modal fade" id="NewZealandModal" tabindex="-1" role="dialog" aria-labelledby="NewZealandModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="NewZealandModalLabel">New Zealand</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="row">
							<div class="col-sm-12 text-center"><h2><a href="https://geca.co.nz">geca.co.nz</a></h2></div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-6" style="background-color: #00b9b5; color: white">
									Chief Representative(s)
							</div>
							<div class="col-sm-6" style="background-color: #f26649; color: white">
									Liaison Officers
							</div>
					  <div class="col-sm-6">
							  <strong>Mr. Geoff Bowker</strong><br>
							  Managing Partner<br>
								Email: geoff.bowker@geca.co.nz<br>
								Tel:    (64) 9522 5451<br>
								Mobile: (64) 27 237 9202<br>
						</div>
						<div class="col-sm-6">
							  <strong>Mr. Geoff Bowker</strong><br>
							  Managing Partner<br>
								Email: geoff.bowker@geca.co.nz<br>
								Tel:    (64) 9522 5451<br>
								Mobile: (64) 27 237 9202<br>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>

@endsection
