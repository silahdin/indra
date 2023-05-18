@extends('layouts.applte')

@section('content')

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('description');
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
            <li><a href="{{ route('projects')}}">Our Projects</a></li>
            <li class="active">Data Projects</li>
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
                  <h3 class="box-title">@lang('main.edit_product')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('projects.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">


                    <div class="form-group">
                        <label for="img_head">@lang('main.gambar_project')</label>
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
            width: 390,
            height: 390,
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
                        <label for="text_en">@lang('main.text_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('text_en') ? ' is-invalid' : '' }}" name="text_en" id="text_en" placeholder="Text English" value="{{ $post->text_en }}" required>
                        @if ($errors->has('text_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="text_in">@lang('main.text_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('text_in') ? ' is-invalid' : '' }}" name="text_in" id="text_in" placeholder="Text Indonesia" value="{{ $post->text_in }}" required>
                        @if ($errors->has('text_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_in') }}</strong>
                            </span>
                        @endif
                    </div>

                   

                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="URL" value="{{ $post->url }}" required>
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
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
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('partner') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
