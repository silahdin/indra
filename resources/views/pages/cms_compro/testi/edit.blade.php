@extends('layouts.applte')

@section('content')

<script src="https://cdn.ckeditor.com/4.11.2/standard-all/ckeditor.js"></script>
<script>
$(function () {
    CKEDITOR.replace('content_in',{
        extraPlugins: 'embed,autoembed,image2',
        height: 500,
        contentsCss: [
        'http://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    });
    CKEDITOR.replace('text_en',{
        extraPlugins: 'embed,autoembed,image2',
        height: 500,
        contentsCss: [
        'http://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    });
    CKEDITOR.replace('content_in',{
        extraPlugins: 'embed,autoembed,image2',
        height: 500,
        contentsCss: [
        'http://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    });
    CKEDITOR.replace('text_en',{
        extraPlugins: 'embed,autoembed,image2',
        height: 500,
        contentsCss: [
        'http://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    });
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
    <section class="content-header">
        <h1>
        &nbsp;
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('testi')}}">Testimoni</a></li>
        <li class="active">Edit Testimoni</li>
        </ol>
    </section>
<?php
// print_r($post);
?>

        <section class="content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_testimoni') : {{ $post->name }}</h3>
                </div>

                <form action="{{ route('testi.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">


                    <div class="form-group">
                        <label for="img_head">@lang('main.gambar_judul')</label>
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
            width: 608,
            height: 322,
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
                        <label for="title_in">@lang('main.judul_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title_in') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Judul Indonesia" value="{{ $post->title_in }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">@lang('main.judul_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Judul English" value="{{ $post->title_en }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">@lang('main.nama')</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama" value="{{ $post->name }}" required/>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text_in">@lang('main.konten_indo')</label>
                        <textarea class="form-control{{ $errors->has('text_in') ? ' is-invalid' : '' }}" name="text_in" id="text_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->text_in }}</textarea>
                        @if ($errors->has('text_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_in') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="text_en">@lang('main.konten_eng')</label>
                        <textarea class="form-control{{ $errors->has('text_en') ? ' is-invalid' : '' }}" name="text_en" id="text_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->text_en }}</textarea>
                        @if ($errors->has('text_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_en') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="position_in">@lang('main.posisi_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('position_in') ? ' is-invalid' : '' }}" name="position_in" id="position_in" placeholder="Posisi Indonesia" value="{{ $post->position_in }}" required/>
                        @if ($errors->has('position_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="position_en">@lang('main.posisi_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('position_en') ? ' is-invalid' : '' }}" name="position_en" id="position_en" placeholder="Posisi English" value="{{ $post->position_en }}" required/>
                        @if ($errors->has('position_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position_en') }}</strong>
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
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('testi') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
