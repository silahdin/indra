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
     CKEDITOR.replace('summary_preview');
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
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('leader')}}">Hal. Leaders</a></li>
            <li class="active">Data Leaders</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add a Leader</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('leader.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">




                  <div class="form-group">
                        <label for="img_head">Photo Leader</label>                        
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px"><!--*Field ini bisa dikosongkan--></span>                        
                            <div class="image-size-label">
                              <!--Atur ulang ukuran gambar-->
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
                        <label for="nama">@lang('main.nama')</label>
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" placeholder="Name" value="{{ old('nama') }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="jabatan">@lang('main.jabatan')</label>
                        <input type="text" class="form-control{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" id="jabatan" placeholder="department" value="{{ old('jabatan') }}" required>
                        @if ($errors->has('jabatan'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('jabatan') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="urutan">@lang('main.urutan')</label>
                        <input type="number" min="1" class="form-control{{ $errors->has('urutan') ? ' is-invalid' : '' }}" name="urutan" id="urutan" placeholder="order" value="{{ old('urutan') }}" required>
                        @if ($errors->has('urutan'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('urutan') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="linkedin">Linkedin Profile URL</label>
                        <input type="text" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" id="linkedin" placeholder="LinkedIn Profile Url" value="{{ old('linkedin') }}">
                        @if ($errors->has('linkedin'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('linkedin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('main.email_address')</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="email@email.com" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="summary_preview">@lang('main.summary_preview')</label>
                        <textarea class="form-control{{ $errors->has('summary_preview') ? ' is-invalid' : '' }}" name="summary_preview" id="summary_preview" placeholder="summary_preview"  cols="5" rows="12" required>{{ old('summary_preview') }}</textarea>
                        @if ($errors->has('summary_preview'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('summary_preview') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="full_summary">@lang('main.summary')</label>
                        <textarea class="form-control{{ $errors->has('full_summary') ? ' is-invalid' : '' }}" name="full_summary" id="full_summary" placeholder="Summary"  cols="5" rows="12" required>{{ old('full_summary') }}</textarea>
                        @if ($errors->has('full_summary'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('full_summary') }}</strong>
                            </span>
                        @endif
                    </div>  

                    <div class="form-group">
                        <label for="edu_cert">@lang('main.edu_certify')</label>
                        <textarea class="form-control{{ $errors->has('edu_cert') ? ' is-invalid' : '' }}" name="edu_cert" id="edu_cert" placeholder="Education and Certification"  cols="5" rows="2" required>{{ old('edu_cert') }}</textarea>
                        @if ($errors->has('edu_cert'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('edu_cert') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="expertise">@lang('main.area_exp')</label>
                        <textarea class="form-control{{ $errors->has('expertise') ? ' is-invalid' : '' }}" name="expertise" id="expertise" placeholder="Area of Expertise"  cols="5" rows="2" required>{{ old('expertise') }}</textarea>
                        @if ($errors->has('expertise'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('expertise') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="industries">@lang('main.menu_industry')</label>
                        <textarea class="form-control{{ $errors->has('industries') ? ' is-invalid' : '' }}" name="industries" id="industries" placeholder="Industries"  cols="5" rows="2" required>{{ old('industries') }}</textarea>
                        @if ($errors->has('industries'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('industries') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="pro_societies">@lang('main.pro_society')</label>
                        <textarea class="form-control{{ $errors->has('pro_societies') ? ' is-invalid' : '' }}" name="pro_societies" id="pro_societies" placeholder="Professional Societies"  cols="5" rows="2" required>{{ old('pro_societies') }}</textarea>
                        @if ($errors->has('pro_societies'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pro_societies') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.add')</button>
                    <a type="button" class="btn btn-default" href="{{ route('leader') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection