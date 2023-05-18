@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/free.jpg');
?>


<div class="section-one text-center margin-right-0" style="background-image: url('{{$imgBanner}}');">
		<!-- <div class="wrapper-color"></div> -->
		<div class="container container-content">
			<div class="row ">
				<div class="col-sm-12 color-white">
					<div class="content-section-one">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 text-center">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="section-content-career">
		<div class="container container-content container-form-job">
			<div class="wrapper-job">
				<div class="row">
					<div class="col-sm-12">

					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" style="display:flex; flex-grow: 1; flex-wrap: nowrap;justify-content: space-between; ">
						<h1 style="">@lang('main.registration_form')</h1>
						<div>
							<a class="btn btn-success" href="allTraining.html">@lang('main.see_training')</a>

						</div>
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-sm-12">
						<span class="fa fa-map-marker"></span> Jakarta Barat, Indonesia |
						<span class="fa fa-laptop"></span> Programmer
					</div> -->
				</div>
				<!-- <div class="row">
					<div class="col-sm-12">
						<hr>
						<h4 style="display: inline-block;">Job Detail</h4>
						<a href="#toggle" data-active="icon-angle-down" data-non-active="icon-angle-up" class="pull-right text-xl show-detail-job-toggle"><i
							 class="fa fa-angle-down"></i></a>
					</div>
				</div> -->
				<div class="row">
					<div class="col-sm-12">
						<hr>
						<strong>@lang('main.student_info')</strong>
						<br>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.full_name')</label>
							<div class="col-lg-9 col-md-9"><input type="text" name="fullname" placeholder="John Doe" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.date_birth')</label>
							<div class="col-lg-9 col-md-9">
								<input type="text" name="bod" placeholder="01-30-1987" data-validate="true" data-name="bod" data-type="single"
								 data-messages="Date of birth" maxlength="15" class="form-control bod form_date">
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b-lg"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;Gender</label>
							<div class="col-lg-9 col-md-9">
								<div class="radio-block"><label class="text-normal radio-inline input-grouping"><input type="radio" name="gender"
										 value="male" data-validate="true" data-name="gender" data-messages="Gender">@lang('main.man')</label><label class="text-normal radio-inline input-grouping"><input
										 type="radio" name="gender" value="female" data-validate="true" data-name="gender" data-messages="Gender">@lang('main.women')</label></div>
							</div>
						</div>
						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.email_address')</label>
							<div class="col-lg-9 col-md-9"><input type="text" name="email" maxlength="100" placeholder="john.doe@email.com"
								 data-validate="true" data-name="email" data-type="single" data-messages="Email" class="form-control input-md email"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.phone_num')</label>
							<div class="col-lg-9 col-md-9">
								<input type="text" name="phone" placeholder="+628140xxxx" class="form-control input-md phone">
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.id_number') (KTP)</label>
							<div class="col-lg-9 col-md-9">
								<input type="number" name="ktp" placeholder="320421xxx" maxlength="100" class="form-control input-md fullname">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<hr>
						<strong>@lang('main.education_back')</strong>
						<br>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.occupation')
							</label>
							<div class="col-lg-9 col-md-9"><input type="text" name="fullname" placeholder="Occupation Name" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.institution_name') </label>
							<div class="col-lg-9 col-md-9"><input type="text" name="fullname" placeholder="Institution Name" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.latest_education')</label>
							<div class="col-lg-9 col-md-9">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">SMA / SMK </option>
									<option value="">SLTA</option>
									<option value="">Diploma 1</option>
									<option value="">Diploma 2</option>
									<option value="">Diploma 3</option>
									<option value="">Diploma 4</option>
									<option value="">Sarjana</option>
									<option value="">Magister</option>
									<option value="">Doctor</option>
								</select>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;Institution
								Name </label>
							<div class="col-lg-9 col-md-9"><input type="text" name="fullname" placeholder="Institution Name" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<hr>
						<strong>@lang('main.training')</strong>
						<br>
						<br>
					</div>
				</div>

				<div class="row" id="applyng">
					<div class="col-sm-12">
						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_program')</label>
							<div class="col-lg-9 col-md-9">
								<select v-model="selectedProg" name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="Basic Care">Basic Care</option>
									<option value="Advance Care">Advance Care</option>
									<option value="Engineering Design">Engineering Design</option>
									<option value="Package Care">Package Care</option>
									<option value="Professional Care">Professional Care</option>
									<option value="Specialist Care">Specialist Care</option>
								</select>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_class')</label>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Basic Care'||selectedProg==''">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">AutoCAD Basic </option>
									<option value="">Revit Basic </option>
									<option value="">Autodesk Inventor Basic</option>
								</select>
							</div>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Advance Care'">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">AutoCAD Piping Drafter</option>
									<option value="">AutoCAD Mechanical Drafter</option>
									<option value="">AutoCAD Civil Drafter</option>
									<option value="">AutoCAD Plant 3D</option>
									<option value="">Autodesk Inventor Advance</option>
									<option value="">Revit Structure Advance</option>
									<option value="">Revit MEP Advance</option>
									<option value="">AutoCAD Civil 3D Fundamental</option>
								</select>
							</div>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Engineering Design'">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">Piping designer</option>
									<option value="">Electrical Designer </option>
									<option value="">Pipe Stress Analysis</option>
									<option value="">Tekla Structure (basic) </option>
									<option value="">PDMS </option>
									<option value="">Tekla Structure (basic) </option>
									<option value="">Tekla Structure (intermediate) </option>
									<option value="">AutoCAD Civil 3D Designer </option>
									<option value="">AutoCAD Plant 3D Designer </option>
								</select>
							</div>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Package Care'">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">AutoCAD Basic & Piping Drafter</option>
									<option value="">AutoCAD Basic & Mechanical Drafter</option>
									<option value="">AutoCAD Basic & Civil Drafter</option>
									<option value="">AutoCAD Basic & Electrical Drafter</option>
									<option value="">AutoCAD Plant 3D Package</option>
									<option value="">Revit Structure Package</option>
									<option value="">Revit MEP Package</option>
									<option value="">AutoCAD Civil 3D Package</option>
									<option value="">PDMS Package (AutoCAD Basic+Piping Drafter+Piping Designer+PDMS)</option>
								</select>
							</div>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Professional Care'">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">Project Management</option>
									<option value="">Plant Design Implementation</option>
									<option value="">HSE Training</option>
									<option value="">Group / Company (min 3 person) </option>
								</select>
							</div>

							<div class="col-lg-9 col-md-9" v-if="selectedProg=='Specialist Care'">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">3D Model Engineering & Integrator</option>
									<option value="">AutoCAD Plant 3D Administrator</option>
									<option value="">Autodesk Inventor Specialist</option>
									<option value="">Autodesk Naviswork Specialist</option>
									<option value="">BIM 360 Doc</option>
								</select>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_schedule')</label>
							<div class="col-lg-9 col-md-9">
								<select name="" id="" class="form-control select-md">
									<option value="">--Choose--</option>
									<option value="">Monday – Wednesday – Friday (09.00 – 12.00)</option>
									<option value="">Monday – Wednesday – Friday (13.00 – 16.00)</option>
									<option value="">Monday – Wednesday – Friday (17.00 – 20.00)</option>
									<option value="">Tuesday – Thursday (08.00 - 12.00)</option>
									<option value="">Tuesday – Thursday (13.00 – 17.00)</option>
									<option value="">Tuesday – Thursday (17.00 - 20.00)</option>
									<option value="">Saturday (09.00 – 12.00 )</option>
								</select>
							</div>
						</div>


						<div class="form-group form-horizontal clearfix m-b-none">
							<input type="submit" name="submit" value="Submit Application" class="btn btn-lg color--brand submit-form btn-apply-job r2x"
							 style="font-size: 14px;">
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script src="https://vuejs.org/js/vue.js"></script>

	<script>
		var app = new Vue({
			el: '#applyng',
			data: {
				selectedProg: ''
				// basicCare: true,
				// advCare: false,
				// engineerDes: false,
				// packageCare: false,
				// ProCare: false,
				// specCare: false,
			},
			methods: {

			}
		})
	</script>


@endsection
