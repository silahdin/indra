@extends('layouts.appcompro')

@section('content')

<style>

.detail-job{
    padding: 10px;
}
.detail-btn-job{
    padding-left:8px;
    padding-right:8px;
}
.detail-btn-job:hover{
    cursor:pointer;
}
</style>

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
								<!-- <h2 class="h2-opening">Halaman Karir</h2> -->
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
						<p>"@lang('main.karir_single1') <a href="{{ route('compro.training', ['id' => $pickOne->id]) }} "> @lang('main.karir_single2')</a> @lang('main.karir_single3')"
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h1>{{ $produk->position }}</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<span class="fa fa-map-marker"></span> {{ $produk->location }}
						<!-- <span class="fa fa-laptop"></span> <?php echo $produk->jobdesk_en; ?> -->
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<hr>
						<h4 style="display: inline-block;">Job Detail</h4>
						<span data-active="icon-angle-down" data-non-active="icon-angle-up" class="detail-btn-job pull-right text-xl show-detail-job-toggle">
                            <i class="showly fa fa-angle-down"></i>
                            <i class="hidly fa fa-angle-up"></i>
                        </span>
                        <div class="detail-job">
                            <br>
                            <?php echo $produk->jobdesk_en; ?>
                            <?php echo $produk->requirement_en; ?>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<hr>
						<strong>@lang('main.karir_person_info')</strong>
						<br>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.karir_name')</label>
							<div class="col-lg-9 col-md-9"><input type="text" name="fullname" placeholder="John Doe" data-validate="true"
								 data-name="fullname" data-type="single" data-messages="Full name" maxlength="100" class="form-control input-md fullname"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.karir_status')</label>
							<div class="col-lg-9 col-md-9">
								<!-- <input type="text" name="status" placeholder="John Doe"  maxlength="100" class="form-control input-md fullname"> -->
								<select name="" id="" class="form-control">
									<option value="">--@lang('main.karir_choose_status')--</option>
									<option value="">Lajang</option>
									<option value="">Menikah</option>
									<option value="">Janda</option>
									<option value="">Duda</option>
								</select>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>No. KTP</label>
							<div class="col-lg-9 col-md-9">
								<input type="number" name="ktp" placeholder="John Doe" maxlength="100" class="form-control input-md fullname">
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>@lang('main.karir_education')</label>
							<div class="col-lg-9 col-md-9">
								<select name="" id="" class="form-control select-md">
									<option value="">--@lang('main.karir_education')--</option>
									<option value="">SLTP</option>
									<option value="">SLTA</option>
									<option value="">Diploma 1</option>
									<option value="">Diploma 2</option>
									<option value="">Diploma 3</option>
									<option value="">Sarjana</option>
									<option value="">Magister</option>
									<option value="">Doktor</option>
								</select>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b-lg"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;Gender</label>
							<div class="col-lg-9 col-md-9">
								<div class="radio-block"><label class="text-normal radio-inline input-grouping"><input type="radio" name="gender"
										 value="male" data-validate="true" data-name="gender" data-messages="Gender">@lang('main.karir_gender_male')</label><label class="text-normal radio-inline input-grouping"><input
										 type="radio" name="gender" value="female" data-validate="true" data-name="gender" data-messages="Gender">@lang('main.karir_gender_female')</label></div>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.date_birth')</label>
							<div class="col-lg-9 col-md-9">
								<input type="text" name="bod" placeholder="01-30-1987" data-validate="true" data-name="bod" data-type="single"
								 data-messages="Date of birth" maxlength="15" class="form-control bod form_date">
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.karir_email')</label>
							<div class="col-lg-9 col-md-9"><input type="text" name="email" maxlength="100" placeholder="john.doe@email.com"
								 data-validate="true" data-name="email" data-type="single" data-messages="Email" class="form-control input-md email"></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.karir_phone')</label>
							<div class="col-lg-9 col-md-9">
								<input type="text" name="phone" placeholder="+628140xxxx" class="form-control input-md phone">
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b"><label class="text-normal col-lg-2 col-md-2 control-label">@lang('main.karir_address')</label>
							<div class="col-lg-9 col-md-9"><textarea name="address" placeholder="Address" data-type="single" maxlength="500"
								 class="input-sm form-control width-100"></textarea></div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;@lang('main.karir_photo')</label>
							<div class="col-lg-9 col-md-9 dropzone-container">
								<div class="dropzone dropzone-upload-photo block hide m-b-sm">
									<figure class="max-width-128 inline v-middle">
										<img src="#" class="img-full"></figure><a data-association="photo"
									 href="javascript:void(0)" class="text-sm inline text-danger remove_photo v-middle m-l-sm"><i class="icon icon-cancel">
									 </i>@lang('main.karir_del_photo')</a>
								</div>
								<span class="fileinput-button btn btn-lg btn-primary r pull-left m-r-sm color--brand text-normal undefined"
								 style="font-size: 11px"><i class="fa fa-upload text"></i> @lang('main.karir_choose_file')<input id="uploadPhoto" type="file" name="photo"
									 data-validate="true" data-type="image" accept="image/*" class="input-file"></span>
								<div style="width: 0%;" class="progress-bar-container progress progress-success progress-striped progress-sm m-t-sm pull-left progress-bar color--brand lter"></div>
							</div>
							<div class="col-lg-9 col-md-9 col-lg-offset-2 input-container">
								<input type="hidden" name="photo_profile"
								 data-validate="true" data-name="photo_profile" data-type="files" data-messages="Photo profile" class="photo-profile">
							</div>
							<div class="col-lg-9 col-md-9 col-lg-offset-2 text-light">
								<span class="text-sm">File types allowed are .jpeg, .jpg, .png (Maximum size 0,5MB).</span>
							</div>
						</div>

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr>*</abbr>&nbsp;Upload CV</label>
							<div class="col-lg-9 col-md-9 dropzone-container">
								<div class="dropzone dropzone-upload-photo block hide m-b-sm">
									<figure class="max-width-128 inline v-middle">
										<img src="#" class="img-full"></figure><a data-association="photo"
									 href="javascript:void(0)" class="text-sm inline text-danger remove_photo v-middle m-l-sm"><i class="icon icon-cancel">
									 </i>@lang('main.karir_del_photo')</a>
								</div>
								<span class="fileinput-button btn btn-lg btn-primary r pull-left m-r-sm color--brand text-normal undefined"
								 style="font-size: 11px"><i class="fa fa-upload text"></i> @lang('main.karir_choose_file')<input id="uploadPhoto" type="file" name="photo"
									 data-validate="true" data-type="image" accept="image/*" class="input-file"></span>
								<div style="width: 0%;" class="progress-bar-container progress progress-success progress-striped progress-sm m-t-sm pull-left progress-bar color--brand lter"></div>
							</div>
							<div class="col-lg-9 col-md-9 col-lg-offset-2 input-container">
								<input type="hidden" name="photo_profile"
								 data-validate="true" data-name="photo_profile" data-type="files" data-messages="Photo profile" class="photo-profile">
							</div>
							<div class="col-lg-9 col-md-9 col-lg-offset-2 text-light">
								<span class="text-sm">File types allowed are .pdf (Maximum size 3MB).</span>
							</div>
						</div>
						<!-- <hr> -->

					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<hr>
						<strong>@lang('main.karir_career_info')</strong>
						<br>
						<br>
					</div>
				</div>

				<div class="row" id="applyng">
					<div class="col-sm-12">

						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr></abbr>@lang('main.karir_occupation') </label>
							<div class="col-lg-9 col-md-9">
								<button class="btn-c" @click="addNewJob">@lang('main.karir_add_occupation') +</button>
							</div>

							<div v-for="(jb,index) in job" class="train-content">
								<div class="col-lg-2 col-md-2 text-right hapusX">
									<span @click="deleteJob(index)" class="">@lang('main.karir_delete') -</span>
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="jb.nameCompany" type="text" name="name" placeholder="Nama Perusahaan" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="jb.addressCompany" type="text" name="name" placeholder="Alamat Perusahaan" maxlength="100"
									 class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="jb.kindCompany" type="text" name="name" placeholder="Jenis Perusahaan" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9 last-train">
									<input v-model="jb.position" type="text" name="name" placeholder="Posisi pekerjaan" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="jb.descriptionPosition" type="text" name="name" placeholder="Deskripsi pekerjaan" maxlength="100"
									 class="form-control input-md fullname">
								</div>

								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-3 col-md-3 ">
									<input v-model="jb.startWorkYear" type="text" name="name" placeholder="Mulai bekerja" maxlength="100" class="form-control input-md fullname form_date"
									 autocomplete="off">
								</div>
								<div class="col-lg-3 col-md-3">
									<input v-model="jb.endWorkYear" type="text" name="name" placeholder="Berhenti bekerja" maxlength="100" class="form-control input-md fullname form_date"
									 autocomplete="off">
								</div>
								<div class="col-lg-3 col-md-3 " style="position:relative">
									<input v-model="jb.longWork" type="number" name="name" placeholder="Lama bekerja" maxlength="100" class="form-control input-md fullname"
									 autocomplete="off">
									<span style="position:absolute; z-index: 1;top: 11px;
									right: 62px;">@lang('main.karir_tahun')</span>
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="jb.reasonResign" type="text" name="name" placeholder="Alasan berhenti" maxlength="100" class="form-control input-md fullname">
									<hr>
								</div>

							</div>
						</div>


						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr></abbr>@lang('main.karir_train') </label>
							<div class="col-lg-9 col-md-9">
								<button class="btn-c" @click="addNewEducation">@lang('main.karir_add_train') +</button>
							</div>

							<div v-for="(train,index) in training" class="train-content">
								<div class="col-lg-2 col-md-2 text-right hapusX">
									<span @click="deleteTraining(index)" class="">@lang('main.karir_delete_train') -</span>
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="train.name" type="text" name="name" placeholder="Nama Tranining" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="train.year" type="text" name="name" placeholder="Tahun" maxlength="100" class="form-control input-md fullname form_year"
									 autocomplete="off">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9" style="position:relative">
									<input v-model="train.year" type="number" name="name" placeholder="Lama waktu training" maxlength="100" class="form-control input-md fullname"
									 autocomplete="off">
									<span style="position:absolute; z-index: 1;top: 11px;
									right: 50px;">@lang('main.karir_hari')</span>
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9 last-train">
									<input v-model="train.about" type="text" name="name" placeholder="Lokasi" maxlength="100" class="form-control input-md fullname">
									<hr>
								</div>
							</div>
						</div>


						<div class="form-group form-horizontal clearfix m-b">
							<label class="text-normal col-lg-2 col-md-2 control-label"><abbr></abbr>@lang('main.karir_organization') </label>
							<div class="col-lg-9 col-md-9">
								<button class="btn-c" @click="addNewOrganisasi">@lang('main.karir_add_organization') +</button>
							</div>

							<div v-for="(org,index) in orga" class="train-content">
								<div class="col-lg-2 col-md-2 text-right hapusX">
									<span @click="deleteOrganisasi(index)" class="">@lang('main.karir_delete_organization') -</span>
								</div>
								<div class="col-lg-9 col-md-9">
									<input v-model="org.nameOrga" type="text" name="name" placeholder="Nama Organisasi" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2"></div>
								<div class="col-lg-9 col-md-9">
									<input v-model="org.positionOrga" type="text" name="name" placeholder="Posisi" maxlength="100" class="form-control input-md fullname">
								</div>
								<div class="col-lg-2 col-md-2"></div>
								<div class="col-lg-9 col-md-9">
									<input v-model="org.yearOrga" type="text" name="name" placeholder="Tahun" maxlength="100" class="form-control input-md fullname form_year"
									 autocomplete="off">
								</div>
								<div class="col-lg-2 col-md-2">
								</div>
								<div class="col-lg-9 col-md-9 last-train" style="position:relative">
									<input v-model="org.longOrga" type="number" name="name" placeholder="Lama menjabat" maxlength="100" class="form-control input-md fullname"
									 autocomplete="off">
									<span style="position:absolute; z-index: 1;top: 11px;
									right: 62px;">@lang('main.karir_tahun')</span>
									<hr>
								</div>
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

	<script>
        $('.detail-job').hide();
        $('.hidly').hide();


        $('.detail-btn-job').click(function(){
            // e.preventDefault();
            // alert('hmmm')
            $('.detail-job').toggle();
            $('.hidly').toggle();
            $('.showly').toggle();

        });
    </script>


	<script src="https://vuejs.org/js/vue.js"></script>

	<script>
		var app = new Vue({
			el: '#applyng',
			data: {
				training: [
					{
						name: '',
						year: '',
						about: ''
					}
				],
				job: [
					{
						nameCompany: '',
						kindCompany: '',
						addressCompany: '',
						position: '',
						descriptionPosition: '',
						startWorkYear: '',
						endWorkYear: '',
						longWork: '',
						reasonResign: ''
					}
				],
				orga: [
					{
						nameOrga: '',
						positionOrga: '',
						yearOrga: '',
						longOrga: '',
					}
				]
			},
			methods: {
				addNewEducation() {
					this.training.push({
						name: '',
						year: '',
						about: ''
					})
				},
				deleteTraining(index) {
					this.training.splice(index, 1);
				},
				addNewOrganisasi() {
					this.orga.push({
						nameOrga: '',
						positionOrga: '',
						yearOrga: '',
						longOrga: '',
					})
				},
				deleteOrganisasi(index) {
					this.orga.splice(index, 1);
				},
				addNewJob() {
					this.job.push({
						nameCompany: '',
						kindCompany: '',
						addressCompany: '',
						position: '',
						descriptionPosition: '',
						startWorkYear: '',
						endWorkYear: '',
						longWork: '',
						reasonResign: ''
					})
				},
				deleteJob(index) {
					this.job.splice(index, 1);
				},
			}
		})
	</script>


@endsection
