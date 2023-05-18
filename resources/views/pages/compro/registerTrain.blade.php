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
			<form action="{{ route('compro.trainRegis') }}" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12" style="display:flex; flex-grow: 1; flex-wrap: nowrap;justify-content: space-between; ">
						<h1 style="">@lang('main.registration_form')</h1>
						<div>
							<a class="btn btn-success" href="{{ route('compro.home') }}#list-training">@lang('main.see_training')</a>
						</div>
					</div>
				</div>
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
							<label class="text-normal col-lg-2 col-md-2 control-label">
								<abbr>*</abbr>&nbsp;@lang('main.full_name')
							</label>

							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
								<input type="text" name="name" placeholder="John Doe" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname" value="{{ $findSaved->name }}" required>
								@else
								<input type="text" name="name" placeholder="John Doe" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname" value="{{ old('name') }}" required>
								@endif
								 <div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('name'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('name') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.date_birth')</label>
							<div class="col-lg-9 col-md-9">
								<div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									@if ($findSaved)
										<input type="text" autocomplete="off" name="birth" class="date-13 form-control datepicker" value="{{ $findSaved->birth }}" placeholder="example, 18-02-2012" required />
									@else
										<input type="text" autocomplete="off" name="birth" class="date-13 form-control datepicker" value="{{ old('birth') }}" placeholder="example, 18-02-2012" required />
									@endif
									<span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
								</div>
								<span style="color:red; font-size:11px" class="age-input">*At least your age must 13 years </span>

								<span style="color:red; font-size:11px;display:none" class="age-input-2">*Invalid type date </span>

								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('birth'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('birth') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b-lg"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;Gender</label>
							<div class="col-lg-9 col-md-9">
								<div class="radio-block">
									@if ($findSaved)
										<label class="text-normal radio-inline input-grouping">
										<input type="radio" name="gender" <?php if($findSaved->gender=='male'){ echo 'checked'; } ?> value="male" data-validate="true" data-name="gender" data-messages="Gender"  required />@lang('main.man')</label>
										<label class="text-normal radio-inline input-grouping">
										<input type="radio" name="gender" <?php if($findSaved->gender=='female'){ echo 'checked'; } ?> value="female" data-validate="true" data-name="gender" data-messages="Gender"  required />W@lang('main.women')omen</label>
									@else
										<label class="text-normal radio-inline input-grouping">
										<input type="radio" name="gender" value="male" data-validate="true" data-name="gender" data-messages="Gender"  required />@lang('main.man')</label>
										<label class="text-normal radio-inline input-grouping">
										<input type="radio" name="gender" value="female" data-validate="true" data-name="gender" data-messages="Gender"  required />@lang('main.women')</label>
									@endif
								</div>
								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('gender'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('gender') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.email_address')</label>
							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
									<input type="text" name="email" maxlength="100" placeholder="john.doe@email.com"
									data-validate="true" data-name="email" data-type="single" data-messages="Email" class="form-control input-md email" value="{{$findSaved->email}}" required />
								@else
									<input type="text" name="email" maxlength="100" placeholder="john.doe@email.com"
									data-validate="true" data-name="email" data-type="single" data-messages="Email" class="form-control input-md email" value="{{ old('email') }}" required />
								@endif
								 <div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('email'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('email') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.phone_num')</label>
							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
									<input type="text" name="phone" placeholder="+628140xxxx" class="form-control input-md phone" value="{{ $findSaved->phone }}" required />
								@else
									<input type="text" name="phone" placeholder="+628140xxxx" class="form-control input-md phone" value="{{ old('phone') }}" required />
								@endif
								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('phone'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('phone') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.id_number') (KTP)</label>
							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
									<input type="text" id ="number" name="ktp" placeholder="320421xxx" maxlength="16" max="16" class="textOnly form-control input-md fullname" value="{{ $findSaved->ktp }}" required />
								@else
									<input type="text" id ="number" name="ktp" placeholder="320421xxx" maxlength="16" max="16" class="textOnly form-control input-md fullname" value="{{ old('ktp') }}" required />
								@endif

								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('ktp'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('ktp') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>
						<script type="text/javascript">
							$('.numbersOnly').keyup(function () {
								this.value = this.value.replace(/[^0-9\.]/g,'');
							});

							$('.textOnly').keyup(function () {
								this.value = this.value.replace(/[^\d+$]/g,'');
							});
						</script>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<hr/>
						<strong>@lang('main.education_back')</strong>
						<br/>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.occupation')
							</label>
							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
									<input type="text" name="occupation" placeholder="Occupation Name" maxlength="200" class="form-control input-md" value="{{ $findSaved->occupation }}" required />
								@else
									<input type="text" name="occupation" placeholder="Occupation Name" maxlength="200" class="form-control input-md" value="{{ old('occupation') }}" required />
								@endif
								 <div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('occupation'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('occupation') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label">
								 <abbr>*</abbr>&nbsp;@lang('main.institution_name')
							</label>
							<div class="col-lg-9 col-md-9">
								@if ($findSaved)
									<input type="text" name="institution" placeholder="Institution Name"  maxlength="200" class="form-control input-md" value="{{ $findSaved->institution }}" required />
								@else
									<input type="text" name="institution" placeholder="Institution Name"  maxlength="200" class="form-control input-md" value="{{ old('institution') }}" required />
								@endif

								 <div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('institution'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('institution') }}</strong>
											 </span>
										 @endif
									 </div>
								 </div>
							</div>
						</div>



						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.latest_education')</label>
							<div class="col-lg-9 col-md-9">
								<select name="education" id="" class="educations form-control select-md" value="{{ old('education') }}" required >
									<option value="">--@lang('main.choose')--</option>
									<option value="SMA / SMK">SMA / SMK </option>
									<option value="SLTA">SLTA</option>
									<option value="Diploma 1">Diploma 1</option>
									<option value="Diploma 2">Diploma 2</option>
									<option value="Diploma 3">Diploma 3</option>
									<option value="Diploma 4">Diploma 4</option>
									<option value="Sarjana">Sarjana</option>
									<option value="Magister">Magister</option>
									<option value="Doctor">Doctor</option>
								</select>
								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('education'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('education') }}</strong>
											 </span>
										 @endif
									 </div>
								</div>
							</div>
						</div>
						@if ($findSaved->education)
							<script>
								$('select.educations').val('{{$findSaved->education}}');
							</script>
						@endif

					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<hr/>
						<strong>@lang('main.training')</strong>
						<br/>
						<br/>
					</div>
				</div>

				<div class="row" id="applyng">

					{{ csrf_field() }}

					<div class="col-sm-12">
						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_training')</label>
							<div class="col-lg-9 col-md-9">
								<select v-model="selectedProg" name="training" id="" class="form-control select-md training" value="{{ old('training') }}" required >
									<option value="">--@lang('main.choose')--</option>
									<?php
									$no = 1;
									foreach ($produk as $pos) { ?>
										<option value="{{$pos->id}}">{{$pos->title_in}}</option>
									<?php
									$no ++;
									}
									?>
								</select>
								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('training'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('training') }}</strong>
											 </span>
										 @endif
									 </div>
								</div>
							</div>
						</div>

						<?php
						$num = 1;
						foreach ($produk as $str) { ?>
						<div class="form-group form-horizontal clearfix m-b classT-{{$str->id}} wrapperClassTrained">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_class')</label>
							<div class="col-lg-9 col-md-9" v-if="selectedProg==1||selectedProg==''">
								<select name="classTrain" class="form-control select-md classTraining classTS-{{$str->id}}  ">
									<option value="0" d-price="0"  view-price="0">--@lang('main.choose')--</option>
									<?php
									foreach ($class as $pos) {
										if($pos->id_training==$str->id){
										?>
										<option value="{{$pos->id}}" d-price="{{$pos->price }}"  view-price="{{ number_format($pos->price) }}">{{$pos->class_name_in }}</option>
										<?php
										}
									} ?>
								</select>
							</div>
						</div>
						<?php
						$num ++;
						}
						?>
								<div class="row">
									<div class="col-sm-2">
									</div>
									 <div class="col-sm-9" style="margin-top: -12px;margin-bottom: 15px;margin-left: 7px;">
										 @if ($errors->has('idClass'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('idClass') }}</strong>
											 </span>
										 @endif
									 </div>
								</div>
						<script>
						$( document ).ready(function(){
							var feeRegis = {{$setting->fee_register}};
							var total = 0;
							var totalView = 0;
							var price = 0;
							var priceView = 0;
							var idTrain = $('select.training option:selected').val();

							if(localStorage.getItem('class')){
								var idclass = localStorage.getItem('class');
								var idtrain = localStorage.getItem('train');
								setTimeout(() => {
									$("select.training").val(idtrain);
									setTimeout(() => {
										$('div.classT-'+idtrain).show(300);
										$("div.classT-"+idtrain+" select.classTraining").val(idclass);
										price = parseInt($('select.classTS-'+idtrain+'	option:selected').attr('d-price'), 10)
										tot = parseInt(price, 10)+parseInt(feeRegis, 10);
										if(tot!==tot){
											tot=0;
										}
										$('#idClass').val(idclass);
										$('label.d-total').html(tot.toLocaleString())
										$('label.d-price').html(price.toLocaleString())

									}, 100);
								}, 900);
								idTrain = idtrain;
							}else{
								idTrain = $('select.training option:selected').val();
							}
							console.log( 'idTrain ='+idTrain );

							$('div.wrapperClassTrained').hide();

							// function show/hide
							$('select.training').change(function(){
								$( "select.training option:selected" ).each(function() {
									idTrain = $('select.training option:selected').val()
									console.log( 'idTrain ='+idTrain );
									total = 0;
									price = 0;
									tot = parseInt(price, 10)+parseInt(feeRegis, 10);
									$('label.d-total').html(tot.toLocaleString());
									$('label.d-price').html(price.toLocaleString());
									$('select.classTS-'+idTrain).val(0);
									$('div.wrapperClassTrained').hide(300);
									$('div.classT-'+idTrain).show(300);
									$('#idClass').val('');
								});
							})
							<?php
 							// function change value CLASS TRAIN
							foreach ($produk as $str) { ?>

								$('select.classTS-{{$str->id}}').change(function(){
									priceView = $(this).attr('d-price');
									price = parseInt($('select.classTS-{{$str->id}}	option:selected').attr('d-price'), 10)
									tot = parseInt(price, 10)+parseInt(feeRegis, 10);

									console.log( '----------');
									console.log( 'id class ='+this.value );
									console.log( 'price = '+price );
									console.log( 'total = '+tot );
									if(tot!==tot){
										tot=0;
									}
									if(this.value == 0){
										$('#idClass').val('');
									}else{
										$('#idClass').val(this.value);
									}
									$('label.d-total').html(tot.toLocaleString())
									$('label.d-price').html(price.toLocaleString())
								})
							<?php
							}
							?>
						})

						</script>

						<div class="form-group form-horizontal clearfix m-b ">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.choose_schedule')</label>
							<div class="col-lg-9 col-md-9">
								<select name="schedule" id="" class="form-control select-md" value="{{ old('schedule') }}" required>
								<option value="">--@lang('main.choose')--</option>
								<?php
								$no = 1;
								foreach ($time as $pos) { ?>
										<option value="{{$pos->id}}"> <strong>{{ str_replace(',','-',$pos->day_in) }}</strong>, {{$pos->time.'-'.$pos->time_end }}</option>
								<?php
								$no ++;
								}
								?>
								</select>
								<div class="row">
									 <div class="col-sm-12">
										 @if ($errors->has('schedule'))
											 <span class="invalid-feedback" style="color: red">
												 <strong>{{ $errors->first('schedule') }}</strong>
											 </span>
										 @endif
									 </div>
								</div>
							</div>
						</div>
						<div class="form-group form-horizontal clearfix m-b mob-flex">
							<label class="text-normal col-lg-2 col-md-2 control-label flex-p-30">@lang('main.register_process_training_order_price')</label>
							<div class="col-lg-9 col-md-9 text-right flex-p-70">
								<label class="text-normal control-label float-left"> : Rp.</label>
								<label class="text-normal control-label d-price">0</label>
							</div>
						</div>
						<div class="form-group form-horizontal clearfix m-b mob-flex">
							<label class="text-normal col-lg-2 col-md-2 control-label flex-p-30">@lang('main.register_process_training_order_registerfee')</label>
							<div class="col-lg-9 col-md-9 text-right flex-p-70">
								<label class="text-normal control-label float-left"> : Rp.</label>
								<label class="text-normal control-label "> {{ number_format($setting->fee_register) }}</label>
								<hr class="hr-price">
							</div>
						</div>
						<div class="form-group form-horizontal clearfix m-b mob-flex">
							<label class="text-normal col-lg-2 col-md-2 control-label flex-p-30">@lang('main.@lang('main.register_process_training_order_total')')</label>
							<div class="col-lg-9 col-md-9 text-right flex-p-70">
								<label class="text-normal control-label float-left"> : Rp.</label>
								<label class="text-normal control-label d-total"> 0</label>
							</div>
						</div>
						<hr>
						<div class="form-group form-horizontal clearfix m-b-none">
							<label class="text-normal col-lg-2 col-md-2 control-label"></label>
							<div class="col-lg-9 col-md-9 text-right">
								<input type="hidden" name="idClass" id="idClass" required/>
								<button type="submit" class="btn btn-lg color--brand submit-form btn-apply-job r2x" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing Order" style="font-size: 14px;">@lang('main.submit_order')</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
    <script src="{{ asset('assets/compro/assets/frontend_assets/js/bootstrap/datetimepicker_3.js') }}"></script>
    <link href="{{ asset('assets/compro/assets/frontend_assets/css/bootstrap/datetimepicker_3.css') }}" rel="stylesheet">

	<script>
	$('.btn').on('click', function() {
		var $this = $(this);
		$this.button('loading');
		setTimeout(function() {
			$this.button('reset');
		}, 2500);
	});
	$('.form_date').datetimepicker({
			format: 'dd-mm-yyyy',   //biar format tanggalnya format Indonesia
			// language:  'id',
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0,
			yearRange: '1999:2012',
			// startDate:
			setStartDate: '2012-01-01',
			maxDate: new Date(),
			minDate: new Date(1999, 10 - 1, 25),
		//   startDate: '-90d'
		yearRange: "-20:+0"
	});
	$('.date-13').change(function(){
		var val = $(this).val();
		var umur = getAge(val)
		var cek = parseDMY(val)
		console.log(getAge(val))
		console.log(parseDMY(val))

		if(cek == 'Invalid Date'){
			$('.age-input-2').show();
			$('.submit-form').attr('disabled','disabled')
		}else{
			$('.submit-form').removeAttr('disabled','disabled')
			$('.age-input-2').hide();
		}

		if(umur<=13 || isNaN(umur)){
			$('.submit-form').attr('disabled','disabled')
			$('.age-input').show();
		}else{
			$('.age-input').hide();
			$('.submit-form').removeAttr('disabled','disabled')
		}
	})


function parseDMY(value) {
	var date = value.split("-");
	var d = parseInt(date[0], 10),
		m = parseInt(date[1], 10),
		y = parseInt(date[2], 10);
	return new Date(y, m - 1, d);
}

function getAge(dateStringReal) {
	dd = dateStringReal.substring(0, 2);
	mm = dateStringReal.substring(3, 5);
	yy = dateStringReal.substring(6, 10);
	dateString = ''+mm+'/'+dd+'/'+yy+'';
	// console.log(dateString)

	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
	{
		age--;
	}else{
		// $('.submit-form').removeAttribute('disabled')

	}

	return age;
}


    </script>
<style>
.hr-price{
	margin-top:17px;
	margin-bottom:0;
}
</style>

@endsection
