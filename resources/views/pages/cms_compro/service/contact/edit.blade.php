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
    CKEDITOR.replace('edu_cert');
    CKEDITOR.replace('expertise');
    CKEDITOR.replace('industries');
    CKEDITOR.replace('pro_societies');
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
            <li><a href="{{ route('serviceContact')}}">Hal. Service</a></li>
            <li class="active">Data Contact</li>
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
                  <h3 class="box-title">@lang('main.edit_contact_name'): {{ $post->name }}</h3>
                </div>

                <form action="{{ route('serviceContact.update', ['id' => $post->contact_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                  <div class="form-group">
                        <label for="img_head">@lang('main.photo_leader')</label>
                        <div>
                            <img src="{{ asset($post->image) }}" alt="" width="300">
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
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" placeholder="Name" value="{{ $post->name }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="jabtan">@lang('main.jabatan')</label>
                        <input type="text" class="form-control{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" id="jabatan" placeholder="Jabatan" value="{{ $post->title }}" required>
                        @if ($errors->has('jabatan'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jabatan') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">@lang('main.urutan')</label>
                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="+6221-xxxxxx" value="{{ $post->phone }}" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
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

                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <a type="button" class="btn btn-default" href="{{ route('serviceContact') }}">@lang('main.cancel')</a>                  
                  </div>
                </form>
              </div>

        </section>
      </div>
@endsection
