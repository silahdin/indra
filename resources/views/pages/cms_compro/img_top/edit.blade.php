@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

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
            <li><a href="{{ route('image_top')}}">Gambar Atas</a></li>
            <li class="active">Edit Gambar Atas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.image_top')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('image_top.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="img_publication ">Gambar Atas Halaman Publikasi (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_publication  ) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_publication">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_publication" class="hidden-image-data-img_publication" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_publication').cropit({
                          // width: 310,
                          // height: 206.5,
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_publication').cropit('export');
                        $('.hidden-image-data-img_publication').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>
                  <br>
                  <br>


                    <div class="form-group">
                        <label for="img_about ">Gambar Atas Halaman Tentang (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_about  ) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_about">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_about" class="hidden-image-data-img_about" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_about').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_about').cropit('export');
                        $('.hidden-image-data-img_about').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>


<br>
<br>


                    <div class="form-group">
                        <label for="img_vision">Gambar Atas Halaman Visi Misi (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_vision) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_vision ">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_vision" class="hidden-image-data-img_vision" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_vision').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_vision').cropit('export');
                        $('.hidden-image-data-img_vision').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>
<br>
<br>



                    <div class="form-group">
                        <label for="img_team">Gambar Atas Halaman Tim Manajemen (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_team) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_team ">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_team" class="hidden-image-data-img_team" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_team').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_team').cropit('export');
                        $('.hidden-image-data-img_team').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>

<br>
<br>

                    <div class="form-group">
                        <label for="img_career">Gambar Atas Halaman Karir (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_career) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_career">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_career" class="hidden-image-data-img_career" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_career').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_career').cropit('export');
                        $('.hidden-image-data-img_career').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>
<br>
<br>


                    <div class="form-group">
                        <label for="img_corporate">Gambar Atas Halaman Tata Kelola (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_corporate) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_corporate">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_corporate" class="hidden-image-data-img_corporate" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_corporate').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_corporate').cropit('export');
                        $('.hidden-image-data-img_corporate').val(imageData);

                        // Print HTTP request params
                        var formValue = $(this).serialize();
                        $('#result-data').text(formValue);

                        // Prevent the form from actually submitting
                        return true;
                      });
                    });
                  </script>
<br>
<br>


                    <div class="form-group">
                        <label for="img_invest">Gambar Atas Halaman Hubungan Investor (ukuran pas 1366px * 251px)</label>
                        <img src="{{ asset($setting->img_invest) }}" alt="" width="683" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <div class="image-editor-img_invest">
                            <input type="file" class="cropit-image-input">
                            <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                            <div class="image-size-label">
                              @lang('main.image_resize')
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%">
                            <input type="hidden" name="img_invest" class="hidden-image-data-img_invest" />
                        </div>
                   </div>
                  <script>
                    $(function() {
                      $('.image-editor-img_invest').cropit({
                          exportZoom: 2,
                          smallImage: 'allow',
                          width: 683,
                          height: 125.5,
                          'minZoom': 1,
                      });

                      $('form').submit(function() {
                        // Move cropped image data to hidden input
                        var imageData = $('.image-editor-img_invest').cropit('export');
                        $('.hidden-image-data-img_invest ').val(imageData);

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
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
