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
    CKEDITOR.replace('question');
    CKEDITOR.replace('answer');
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
            <li class="active">Data Follows</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Follows</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('follow.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    

                    <div class="form-group">
                        <label for="textline">Textline</label>
                        <input type="text" class="form-control{{ $errors->has('textline') ? ' is-invalid' : '' }}" name="textline" id="textline" placeholder="Textline" value="{{ @$post->textline }}" required>
                        @if ($errors->has('textline'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('textline') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="img_head">Icon</label>
                        <div>
                            <img src="{{ asset($post->icon) }}" alt="" width="300">
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
                        <label for="link">Link URL</label>
                        <input type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" id="link" placeholder="Link URL" value="{{ @$post->link }}">
                        @if ($errors->has('link'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="link_open">Link Open In</label>
                        <select class="form-control{{ $errors->has('link_open') ? ' is-invalid' : '' }}" name="link_open" id="link_open" style="width: 100%;" required>
                            <option value="">-- Choose Link Open --</option>
                            <option value="0" {{ (@$post->link_open == 0) ? 'selected' : '' }}>Same Page</option>
                            <option value="1" {{ (@$post->link_open == 1) ? 'selected' : '' }}>New Page</option>
                        </select>
                        @if ($errors->has('link_open'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('link_open') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status" style="width: 100%;" required>
                            <option value="">-- Choose Status --</option>
                            <option value="1" {{ (@$post->status == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ (@$post->status == 0) ? 'selected' : '' }}>Not Active</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-default" href="{{ route('follow') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection