@extends('layouts.applte')

@section('content')
<!-- DataTables -->
<!-- E:\xampp\htdocs\gratama_office\public\assets\lte\bower_components\bootstrap-datepicker\dist\css -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
})
</script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('detRole_en');
    CKEDITOR.replace('detRole_ch');
    CKEDITOR.replace('detRespon_en');
    CKEDITOR.replace('detRespon_ch');
    CKEDITOR.replace('detSkill_en');
    CKEDITOR.replace('detSkill_ch');
});
</script>

<script src="{{ asset('assets/lte/bower_components/cropit/jquery.cropit.js') }}"></script>
<style>
  .cropit-preview {
  background-color: #f8f8f8;
  background-size: cover;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-top: 7px;
  width: 250px;
  height: 250px;
  }

  .cropit-preview-image-container {
  cursor: move;
  }

  .image-size-label {
  margin-top: 10px;
  }

  input {
  display: block;
  }

  button[type="submit"] {
  /* margin-top: 10px; */
  }

  #result {
  margin-top: 10px;
  width: 900px;
  }

  #result-data {
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  word-wrap: break-word;
  }

  .slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;   
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
  }

  .slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%; 
  background: #a53a3a;
  cursor: pointer;
  }

  .slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #a53a3a;
  cursor: pointer;
  }
</style>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> @lang('main.sidebar_home')</a></li>
            <li><a href="{{ route('career')}}">@lang('main.sidebar_karir')</a></li>
            <li class="active">@lang('main.sidebar_karir_')</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.add_careers')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('career.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">




                  <div class="form-group">
                        <label for="img_head">@lang('main.pictures_career')</label>                        
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px"><!--*This field can be left blank--></span>                        
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                   </div>
    <script>
      $(function() {
        $('.image-editor').cropit({ 
            // width: 310,
            // height: 206.5,
            smallImage: 'allow' ,               
            width: 336,
            height: 336,            
            'minZoom': 1
        });

        $('form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export');
          $('.hidden-image-data').val(imageData);

          // Print HTTP request params
          var formValue = $(this).serialize();
          $('#result-data').text(formValue);

          // Prevent the form from actually submitting
          return true;
        });
      });
    </script>

                    <div class="form-group">
                        <label for="position_ch">@lang('main.posisi_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="position_en" id="position_en" placeholder="Posisi" value="{{ old('position_en') }}" required>
                        @if ($errors->has('position_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="position_ch">@lang('main.posisi_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="position_ch" id="position_ch" placeholder="Posisi" value="{{ old('position_ch') }}" required>
                        @if ($errors->has('position_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="url">Url Slug</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="Title Chinese" value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px"><!--*This field if left blank will automatically generate a URL in accordance with the position of the field above--></span>
                    </div>

                    

                    <div class="form-group">
                        <label for="jobdesk_en">@lang('main.jabatanen')</label>
                        <textarea class="form-control{{ $errors->has('jobdesk_en') ? ' is-invalid' : '' }}" name="jobdesk_en" id="jobdesk_en" placeholder="Jabatan English"  cols="5" rows="2" required>{{ old('jobdesk_en') }}</textarea>
                        @if ($errors->has('jobdesk_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jobdesk_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jobdesk_ch">@lang('main.jabatanin')</label>
                        <textarea class="form-control{{ $errors->has('jobdesk_in') ? ' is-invalid' : '' }}" name="jobdesk_ch" id="jobdesk_ch" placeholder="Jabatan Chinese"  cols="5" rows="2" required>{{ old('jobdesk_ch') }}</textarea>
                        @if ($errors->has('jobdesk_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jobdesk_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    

                    <div class="form-group">
                        <label for="detRole_en">@lang('main.role_eng')</label>
                        <textarea class="form-control{{ $errors->has('detRole_en') ? ' is-invalid' : '' }}" name="detRole_en" id="detRole_en" placeholder="Kualifikasi English"  cols="5" rows="2" required>{{ old('detRole_en') }}</textarea>
                        @if ($errors->has('detRole_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRole_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detRole_ch">@lang('main.role_indo')</label>
                        <textarea class="form-control{{ $errors->has('detRole_ch') ? ' is-invalid' : '' }}" name="detRole_ch" id="detRole_ch" placeholder="Kualifikasi Chinese"  cols="5" rows="2" required>{{ old('detRole_ch') }}</textarea>
                        @if ($errors->has('detRole_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRole_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    

                    <div class="form-group">
                        <label for="detRespon_en">@lang('main.key_eng')</label>
                        <textarea class="form-control{{ $errors->has('detRespon_en') ? ' is-invalid' : '' }}" name="detRespon_en" id="detRespon_en" placeholder="Key Responsibilities English"  cols="5" rows="2" required>{{ old('detRespon_en') }}</textarea>
                        @if ($errors->has('detRespon_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRespon_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detRespon_ch">@lang('main.key_indo')</label>
                        <textarea class="form-control{{ $errors->has('detRespon_ch') ? ' is-invalid' : '' }}" name="detRespon_ch" id="detRespon_ch" placeholder="Key Responsibilities Chinese"  cols="5" rows="2" required>{{ old('detRespon_ch') }}</textarea>
                        @if ($errors->has('detRespon_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRespon_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    

                    <div class="form-group">
                        <label for="detSkill_en">@lang('main.skill_eng')</label>
                        <textarea class="form-control{{ $errors->has('detSkill_en') ? ' is-invalid' : '' }}" name="detSkill_en" id="detSkill_en" placeholder="Skills & Qualifications English"  cols="5" rows="2" required>{{ old('detSkill_en') }}</textarea>
                        @if ($errors->has('detSkill_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detSkill_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detSkill_ch">@lang('main.skill_indo')</label>
                        <textarea class="form-control{{ $errors->has('detSkill_ch') ? ' is-invalid' : '' }}" name="detSkill_ch" id="detSkill_ch" placeholder="Skills & Qualifications Chinese"  cols="5" rows="2" required>{{ old('detSkill_ch') }}</textarea>
                        @if ($errors->has('detSkill_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detSkill_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="location_en">@lang('main.location')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="location_en" id="location_en" placeholder="Lokasi" value="{{ old('location_en') }}" required>
                        @if ($errors->has('location'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('location_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="location_ch">@lang('main.location_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="location_ch" id="location_ch" placeholder="Lokasi" value="{{ old('location_ch') }}" required>
                        @if ($errors->has('location_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('location_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="date_start">@lang('main.start_date')</label>
                            <div class="input-group date" class="form-control{{ $errors->has('date_start') ? ' is-invalid' : '' }}" data-provide="datepicker" >
                                <input  maxlength="10" class="form-control " size="10" type="text" name="date_start" id="date_start" placeholder="contoh, 11-08-2012" required>
                                <span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="date_end">@lang('main.tanggal') :</label>
                            <div class="input-group date" class="form-control{{ $errors->has('date_end') ? ' is-invalid' : '' }}" data-provide="datepicker" >
                                <input  maxlength="10" id="date_end" class="form-control " size="10" type="text" name="date_end" placeholder="contoh, 11-08-2012" required>
                                <span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
                            </div>
                    </div>                    

                    <div class="form-group">
                        <label for="rowstate">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate" id="rowstate" style="width: 100%;" required>
                            <option value="">--@lang('main.karir_choose_status')--</option>
                            <option value="1">@lang('main.activity')</option>
                            <option value="2">@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('rowstate'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('rowstate') }}</strong>
                            </span>
                        @endif
                    </div>                   

                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.add')</button>
                    <a type="button" class="btn btn-default" href="{{ route('career') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection