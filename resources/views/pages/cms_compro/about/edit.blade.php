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
    CKEDITOR.replace('content_en',{
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

    CKEDITOR.replace('content_service_in',{
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
    CKEDITOR.replace('content_service_en',{
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('about')}}">Hal. About us</a></li>
            <li class="active">Data About us</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit About us</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('about.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

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

<!--
                    <div class="form-group">
                        <label for="text_in">Text Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text_in') ? ' is-invalid' : '' }}" name="text_in" id="text_in" placeholder="Text Indonesia" value="{{ $post->text_in }}" required>
                        @if ($errors->has('text_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text_en">Text English</label>
                        <input type="text" class="form-control{{ $errors->has('text_en') ? ' is-invalid' : '' }}" name="text_en" id="text_en" placeholder="Text English" value="{{ $post->text_en }}" required>
                        @if ($errors->has('text_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_en') }}</strong>
                            </span>
                        @endif
                    </div>                     -->

<!--
                    <div class="form-group">
                        <label for="img_head">Gambar </label>
                        <img src="{{ asset($post->img) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*Kosongkan inputan gambar jika tidak ingin mengubah gambar</span>
                            <div class="image-size-label">
                              Atur ulang ukuran gambar
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                   </div> -->

    <script>
    //   $(function() {
    //     $('.image-editor').cropit({
    //         smallImage: 'allow' ,
    //         width: 589,
    //         height: 316,
    //         'minZoom': 1
    //     });

    //     $('form').submit(function() {
    //       // Move cropped image data to hidden input
    //       var imageData = $('.image-editor').cropit('export');
    //       $('.hidden-image-data').val(imageData);

    //       // Print HTTP request params
    //       var formValue = $(this).serialize();
    //       $('#result-data').text(formValue);

    //       // Prevent the form from actually submitting
    //       return true;
    //     });
    //   });
    </script>

                    <div class="form-group">
                        <label for="content_in">@lang('main.konten_indo')</label>
                        <textarea class="form-control{{ $errors->has('content_in') ? ' is-invalid' : '' }}" name="content_in" id="content_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->content_in }}</textarea>
                        @if ($errors->has('content_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content_en">@lang('main.konten_eng')</label>
                        <textarea class="form-control{{ $errors->has('content_en') ? ' is-invalid' : '' }}" name="content_en" id="content_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->content_en }}</textarea>
                        @if ($errors->has('content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_en') }}</strong>
                            </span>
                        @endif
                    </div>

<hr>
                    <div class="form-group">
                        <label for="title_service_in">@lang('main.judul_serve_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title_service_in') ? ' is-invalid' : '' }}" name="title_service_in" id="title_service_in" placeholder="Judul Indonesia" value="{{ $post->title_service_in }}" required>
                        @if ($errors->has('title_service_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_service_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_service_en">@lang('main.judul_serve_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('title_service_en') ? ' is-invalid' : '' }}" name="title_service_en" id="title_service_en" placeholder="Judul English" value="{{ $post->title_service_en }}" required>
                        @if ($errors->has('title_service_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_service_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content_service_in">@lang('main.serve_indo')</label>
                        <textarea class="form-control{{ $errors->has('content_service_in') ? ' is-invalid' : '' }}" name="content_service_in" id="content_service_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->content_service_in }}</textarea>
                        @if ($errors->has('content_service_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_service_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content_service_en">@lang('main.serve_eng')</label>
                        <textarea class="form-control{{ $errors->has('content_service_en') ? ' is-invalid' : '' }}" name="content_service_en" id="content_service_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->content_service_en }}</textarea>
                        @if ($errors->has('content_service_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_service_en') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
