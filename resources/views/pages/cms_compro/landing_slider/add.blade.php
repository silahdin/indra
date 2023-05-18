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
    CKEDITOR.replace('brief');
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
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('main.sidebar_home')</a></li>
            <li><a href="javascript:void(0);">Front Page</a></li>
            <li class="active">Data Slider</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Landing Page Slider</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('landing.slider.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input type="text" class="form-control{{ $errors->has('sub_title') ? ' is-invalid' : '' }}" name="sub_title" id="sub_title" placeholder="Sub Title" value="{{ old('sub_title') }}">
                        @if ($errors->has('sub_title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('sub_title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="brief">Brief</label>
                        <textarea class="form-control{{ $errors->has('brief') ? ' is-invalid' : '' }}" name="brief" id="brief" placeholder="Brief"  cols="5" rows="3">{{ old('brief') }}</textarea>
                        @if ($errors->has('brief'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('brief') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="link_text">Link Text</label>
                        <input type="text" class="form-control{{ $errors->has('link_text') ? ' is-invalid' : '' }}" name="link_text" id="link_text" placeholder="Link Text" value="{{ old('link_text') }}">
                        @if ($errors->has('link_text'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('link_text') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="link_url">Link URL</label>
                        <input type="text" class="form-control{{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" id="link_url" placeholder="Link URL" value="{{ old('link_url') }}">
                        @if ($errors->has('link_url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('link_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="link_open">Link Open In</label>
                        <select class="form-control{{ $errors->has('link_open') ? ' is-invalid' : '' }}" name="link_open" id="link_open" style="width: 100%;" required>
                            <option value="">-- Choose Link Open --</option>
                            <option value="0">Same Page</option>
                            <option value="1">New Page</option>
                        </select>
                        @if ($errors->has('link_open'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('link_open') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="img_head">Image Background</label>                        
                        <div class="image-editor">
                            <input name="file" type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: green; font-size: 12px">*Recommended Size : 1300x600</span>                        
                            
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                   </div>

                   <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status" style="width: 100%;" required>
                            <option value="">-- Choose Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
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

                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.add')</button>
                    <a type="button" class="btn btn-default" href="{{ route('landing.slider') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection