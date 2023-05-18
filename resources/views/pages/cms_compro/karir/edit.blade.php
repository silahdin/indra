<?php
        function convert_tgl_to_user($tgl){
            //UBAH TANGGAL BIAR BISA TAMPILANNYA B.INDO
            $tgl_1 = substr($tgl, 0,4);
            $tgl_2 = substr($tgl, 5,2);
            $tgl_3 = substr($tgl, 8,2);
            $tgl = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $tgl;
        }
?>
@extends('layouts.applte')

@section('content')
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
    CKEDITOR.replace('detRole_ch');
    CKEDITOR.replace('detRole_en');
    CKEDITOR.replace('detRespon_ch');
    CKEDITOR.replace('detRespon_en');
    CKEDITOR.replace('detSkill_ch');
    CKEDITOR.replace('detSkill_en');
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

<?php
// print_r($post);
?>
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_karir'):
                  <?php
        			    $lang_org = session('language');
        			    if($lang_org=='en')
        			        {
        			            echo $post->position_en;
        			        }
        			        else
        			        {
        			            echo $post->position_ch;
        			        }
        			    
        			?>
                  </h3>
                </div>

                <form action="{{ route('career.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                  <div class="form-group">
                        <label for="img_head">@lang('main.gambar_karir')</label>
                        <div>
                            <img src="{{ asset($post->img) }}" alt="" width="300">
                            <br>
                            <br>
                        </div>
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
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
            // width: 620,
            // height: 413,
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
                        <label for="position">@lang('main.posisi_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="position_en" id="position_en" placeholder="Position english" value="{{ $post->position_en }}" required>
                        @if ($errors->has('position'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="position">@lang('main.posisi_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="position_ch" id="position_ch" placeholder="position chinese " value="{{ $post->position_ch }}" required>
                        @if ($errors->has('position_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="url">@lang('main.url_slug')</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="URL Slug" value="{{ $post->url }}" required>
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="jobdesk_in">@lang('main.jabatanen')</label>
                        <textarea class="form-control{{ $errors->has('jobdesk_en') ? ' is-invalid' : '' }}" name="jobdesk_en" id="jobdesk_en" placeholder="department english"  cols="5" rows="2" required>{{ $post->jobdesk_en }}</textarea>
                        @if ($errors->has('jobdesk_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jobdesk_in') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jobdesk_ch">@lang('main.jabatanin')</label>
                        <textarea class="form-control{{ $errors->has('jobdesk_ch') ? ' is-invalid' : '' }}" name="jobdesk_ch" id="jobdesk_ch" placeholder="department Chinese"  cols="5" rows="2" required>{{ $post->jobdesk_ch }}</textarea>
                        @if ($errors->has('jobdesk_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jobdesk_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                        <div class="form-group">
                        <label for="detRole_en">@lang('main.role_eng')</label>
                        <textarea class="form-control{{ $errors->has('detRole_en') ? ' is-invalid' : '' }}" name="detRole_en" id="detRole_en" placeholder="Role Summary English"  cols="5" rows="2" required>{{ $post->detRole_en }}</textarea>
                        @if ($errors->has('detRole_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRole_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detRole_ch">@lang('main.role_indo')</label>
                        <textarea class="form-control{{ $errors->has('detRole_ch') ? ' is-invalid' : '' }}" name="detRole_ch" id="detRole_ch" placeholder="Role Summary Chinese"  cols="5" rows="2" required>{{ $post->detRole_ch }}</textarea>
                        @if ($errors->has('detRole_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRole_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="form-group">
                        <label for="detRespon_en">@lang('main.key_eng')</label>
                        <textarea class="form-control{{ $errors->has('detRespon_en') ? ' is-invalid' : '' }}" name="detRespon_en" id="detRespon_en" placeholder="Key Responsibilities English"  cols="5" rows="2" required>{{ $post->detRespon_en }}</textarea>
                        @if ($errors->has('detRespon_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRespon_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detRespon_ch">@lang('main.key_indo')</label>
                        <textarea class="form-control{{ $errors->has('detRespon_ch') ? ' is-invalid' : '' }}" name="detRespon_ch" id="detRespon_ch" placeholder="Key Responsibilities Chinese"  cols="5" rows="2" required>{{ $post->detRespon_ch }}</textarea>
                        @if ($errors->has('detRespon_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detRespon_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="form-group">
                        <label for="detSkill_en">@lang('main.skill_eng')</label>
                        <textarea class="form-control{{ $errors->has('detSkill_en') ? ' is-invalid' : '' }}" name="detSkill_en" id="detSkill_en" placeholder="Skills & Qualifications English"  cols="5" rows="2" required>{{ $post->detSkill_en }}</textarea>
                        @if ($errors->has('detSkill_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detSkill_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="detSkill_ch">@lang('main.skill_indo')</label>
                        <textarea class="form-control{{ $errors->has('detSkill_ch') ? ' is-invalid' : '' }}" name="detSkill_ch" id="detSkill_ch" placeholder="Skills & Qualifications Indonesia"  cols="5" rows="2" required>{{ $post->detSkill_ch }}</textarea>
                        @if ($errors->has('detSkill_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('detSkill_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    



                    <div class="form-group">
                        <label for="location_en">@lang('main.location')</label>
                        <textarea class="form-control{{ $errors->has('location_en') ? ' is-invalid' : '' }}" name="location_en" id="location_en" placeholder="location"  cols="5" rows="2" required>{{ $post->location_en }}</textarea>
                        @if ($errors->has('location_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('location_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="location_ch">@lang('main.location_ch')</label>
                        <textarea class="form-control{{ $errors->has('location_ch') ? ' is-invalid' : '' }}" name="location_ch" id="location_ch" placeholder="location chinese"  cols="5" rows="2" required>{{ $post->location_ch }}</textarea>
                        @if ($errors->has('location_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('location_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="date_start">@lang('main.start_date')</label>
                            <div class="input-group date" class="form-control{{ $errors->has('date_start') ? ' is-invalid' : '' }}" data-provide="datepicker" >
                                <input  maxlength="10" class="form-control " size="10" type="text" name="date_start" id="date_start" placeholder="contoh, 11/08/2012" value="{{ convert_tgl_to_user($post->date_start) }}" required>
                                <span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
                            </div>
                        @if ($errors->has('date_start'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('date_start') }}</strong>
                            </span>
                        @endif
                    </div>

                   <div class="form-group">
                        <label for="date_end">@lang('main.tanggal') :</label>
                            <div class="input-group date" class="form-control{{ $errors->has('date_end') ? ' is-invalid' : '' }}" data-provide="datepicker" >
                                <input  maxlength="10" class="form-control " size="10" type="text" name="date_end" id="date_end" placeholder="contoh, 11/08/2012" value="{{ convert_tgl_to_user($post->date_end) }}" required>
                                <span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
                            </div>
                        @if ($errors->has('date_end'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('date_end') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="rowstate">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate" id="rowstate" style="width: 100%;" required>
                            <option value="">--@lang('main.karir_choose_status')--</option>
                            <option value="1" @if($post->rowstate==1) selected @endif>@lang('main.activity')</option>
                            <option value="2" @if($post->rowstate==2) selected @endif>@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('rowstate'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('rowstate') }}</strong>
                            </span>
                        @endif
                    </div>
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <a type="button" class="btn btn-default" href="{{ route('career') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>

        </section>
      </div>
@endsection
