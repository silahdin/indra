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
    // CKEDITOR.replace('summary_preview');
    CKEDITOR.replace('full_summary');
    CKEDITOR.replace('full_summary_ch');
    CKEDITOR.replace('edu_cert');
    CKEDITOR.replace('edu_cert_ch');
    CKEDITOR.replace('expertise');
    CKEDITOR.replace('expertise_ch');
    CKEDITOR.replace('industries');
    CKEDITOR.replace('industries_ch');
    CKEDITOR.replace('pro_societies');
    CKEDITOR.replace('pro_societies_ch');
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
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('leader')}}">Hal. Leaders</a></li>
            <li class="active">Data Leader</li>
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
                  <h3 class="box-title">@lang('main.edit_leader'): 
                 
                  
                  <?php
                  $lang_org = session('language');
			        if($lang_org=='en')
			        {
			            echo $post->nama;
			        }
			        else
			        {
			            echo $post->nama_ch;
			        }
			    
			    ?>
                  </h3>
                </div>

                <form action="{{ route('leader.update', ['id' => $post->leader_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                  <div class="form-group">
                        <label for="img_head">@lang('main.photo_leader')</label>
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
                        <label for="nama">@lang('main.nama')</label>
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" placeholder="Nama" value="{{ $post->nama }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama">@lang('main.nama_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('nama-ch') ? ' is-invalid' : '' }}" name="nama_ch" id="nama_ch" placeholder="Nama_ch" value="{{ $post->nama_ch }}" required>
                        @if ($errors->has('nama_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="jabtan">@lang('main.jabatan')</label>
                        <input type="text" class="form-control{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" id="jabatan" placeholder="Jabatan" value="{{ $post->jabatan }}" required>
                        @if ($errors->has('jabatan'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jabatan') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="jabtan">@lang('main.jabatan_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('jabatan_ch') ? ' is-invalid' : '' }}" name="jabatan_ch" id="jabatan_ch" placeholder="Jabatan" value="{{ $post->jabatan_ch }}" required>
                        @if ($errors->has('jabatan_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jabatan_ch') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="urutan">@lang('main.urutan')</label>
                        <input type="number" min="1" class="form-control{{ $errors->has('urutan') ? ' is-invalid' : '' }}" name="urutan" id="urutan" placeholder="Urutan" value="{{ $post->urutan }}" required>
                        @if ($errors->has('urutan'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('urutan') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="linkedin">Linkedin Profile URL</label>
                        <input type="text" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" id="linkedin" placeholder="LinkedIn Profile Url" value="{{ $post->linkedin }}">
                        @if ($errors->has('linkedin'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('linkedin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('main.email_address')</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="email@email.com" value="<?php if($post->email == '-'){echo "";}else{echo $post->email;}?>">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="summary_preview">@lang('main.summary_preview')</label>
                        <textarea class="form-control{{ $errors->has('summary_preview') ? ' is-invalid' : '' }}" name="summary_preview" id="summary_preview" placeholder="summary_preview"  cols="5" rows="12" required>{{ $post->summary_preview }}</textarea>
                        @if ($errors->has('summary_preview'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('summary_preview') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="summary_preview">@lang('main.summary_preview_ch')</label>
                        <textarea class="form-control{{ $errors->has('summary_preview_ch') ? ' is-invalid' : '' }}" name="summary_preview_ch" id="summary_preview_ch" placeholder="summary_preview"  cols="5" rows="12" required>{{ $post->summary_preview_ch }}</textarea>
                        @if ($errors->has('summary_preview_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('summary_preview_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="full_summary">@lang('main.summary')</label>
                        <textarea class="form-control{{ $errors->has('full_summary') ? ' is-invalid' : '' }}" name="full_summary" id="full_summary" placeholder="Summary"  cols="5" rows="12" required>{{ $post->full_summary }}</textarea>
                        @if ($errors->has('full_summary'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('full_summary') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="full_summary">@lang('main.summary_ch')</label>
                        <textarea class="form-control{{ $errors->has('full_summary_ch') ? ' is-invalid' : '' }}" name="full_summary_ch" id="full_summary_ch" placeholder="Summary"  cols="5" rows="12" required>{{ $post->full_summary_ch }}</textarea>
                        @if ($errors->has('full_summary_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('full_summary_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="edu_cert">@lang('main.edu_certify')</label>
                        <textarea class="form-control{{ $errors->has('edu_cert') ? ' is-invalid' : '' }}" name="edu_cert" id="edu_cert" placeholder="Education and Certification"  cols="5" rows="2" required>{{ $post->edu_cert }}</textarea>
                        @if ($errors->has('edu_cert'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('edu_cert') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="edu_cert">@lang('main.edu_certify_ch')</label>
                        <textarea class="form-control{{ $errors->has('edu_cert_ch') ? ' is-invalid' : '' }}" name="edu_cert_ch" id="edu_cert_ch" placeholder="Education and Certification"  cols="5" rows="2" required>{{ $post->edu_cert_ch }}</textarea>
                        @if ($errors->has('edu_cert_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('edu_cert_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="expertise">@lang('main.area_exp')</label>
                        <textarea class="form-control{{ $errors->has('expertise') ? ' is-invalid' : '' }}" name="expertise" id="expertise" placeholder="Area of Expertise"  cols="5" rows="2" required>{{ $post->expertise }}</textarea>
                        @if ($errors->has('expertise'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('expertise') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="expertise">@lang('main.area_exp_ch')</label>
                        <textarea class="form-control{{ $errors->has('expertise_ch') ? ' is-invalid' : '' }}" name="expertise_ch" id="expertise_ch" placeholder="Area of Expertise"  cols="5" rows="2" required>{{ $post->expertise_ch }}</textarea>
                        @if ($errors->has('expertise_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('expertise_ch') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="industries">@lang('main.menu_industry')</label>
                        <textarea class="form-control{{ $errors->has('industries') ? ' is-invalid' : '' }}" name="industries" id="industries" placeholder="Industries"  cols="5" rows="2" required>{{ $post->industries }}</textarea>
                        @if ($errors->has('industries'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('industries') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="industries">@lang('main.menu_industry_ch')</label>
                        <textarea class="form-control{{ $errors->has('industries_ch') ? ' is-invalid' : '' }}" name="industries_ch" id="industries_ch" placeholder="Industries"  cols="5" rows="2" required>{{ $post->industries_ch }}</textarea>
                        @if ($errors->has('industries_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('industries_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                    <div class="form-group">
                        <label for="pro_societies">@lang('main.pro_society')</label>
                        <textarea class="form-control{{ $errors->has('pro_societies') ? ' is-invalid' : '' }}" name="pro_societies" id="pro_societies" placeholder="Professional Societies"  cols="5" rows="2" required>{{ $post->pro_societies }}</textarea>
                        @if ($errors->has('pro_societies'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pro_societies') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="pro_societies">@lang('main.pro_society_ch')</label>
                        <textarea class="form-control{{ $errors->has('pro_societies_ch') ? ' is-invalid' : '' }}" name="pro_societies_ch" id="pro_societies_ch" placeholder="Professional Societies"  cols="5" rows="2" required>{{ $post->pro_societies_ch }}</textarea>
                        @if ($errors->has('pro_societies_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pro_societies_ch') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    

                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <a type="button" class="btn btn-default" href="{{ route('leader') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>

        </section>
      </div>
@endsection
