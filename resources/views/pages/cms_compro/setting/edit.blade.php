@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script src="https://cdn.ckeditor.com/4.11.2/standard-all/ckeditor.js"></script>
<script>
$(function () {
    CKEDITOR.replace('alamat',{
        extraPlugins: 'embed,autoembed,image2',
        height: 150,
        contentsCss: [
        'https://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        // 'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
    });

    CKEDITOR.replace('ocv',{
        extraPlugins: 'embed,autoembed,image2',
        height: 500,
        contentsCss: [
        'https://cdn.ckeditor.com/4.11.2/full-all/contents.css',
        // 'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
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

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> @lang('main.sidebar_home')</a></li>
            <li><a href="{{ route('setting_comp')}}">@lang('main.core_value')</a></li>
            <li class="active">@lang('main.sidebar_setting')</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_setting')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('setting_comp.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group" style="display:none">
                        <label for="title_in">@lang('main.title_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title_in') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Title" value="{{ $setting->title_in }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">@lang('main.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Title" value="{{ $setting->title_en }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sitename">URL Website</label>
                        <input type="text" class="form-control{{ $errors->has('sitename') ? ' is-invalid' : '' }}" name="sitename" id="sitename" placeholder="Title" value="{{ $setting->sitename }}" required>
                        @if ($errors->has('sitename'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('sitename') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- <div class="form-group">
                        <label for="logo_src">Logo Web</label>
                        <img src="{{ asset($setting->logo_src) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('logo_src') ? ' is-invalid' : '' }}" name="logo_src" id="logo_src">
                        @if ($errors->has('logo_src'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('logo_src') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*Kosongkan inputan gambar jika tidak ingin mengubah gambar</span>
                    </div>                     -->

                    <div class="form-group">
                      <label for="no_tlp">@lang('main.no_telephone')</label>
                      <input type="text" class="form-control{{ $errors->has('no_tlp') ? ' is-invalid' : '' }}" name="no_tlp" id="no_tlp" placeholder="No. Telepon" value="{{ $setting->no_tlp }}" required>
                      @if ($errors->has('no_tlp'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('no_tlp') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="email">@lang('main.karir_email')</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $setting->email }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                  <label for="alamat">@lang('main.alamat')</label>
                  <textarea class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" id="alamat" required>{{ $setting->alamat }}</textarea>
                  @if ($errors->has('alamat'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('alamat') }}</strong>
                          </span>
                      @endif
                </div>

               {{--  <div class="form-group">
                <label for="keywords">@lang('main.keyword')</label>
                <textarea class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" name="keywords" id="keywords" required>{{ $setting->keywords }}</textarea>
                @if ($errors->has('keywords'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('keywords') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                <label for="description">@lang('main.descript')</label>
                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ $setting->description }}</textarea>
                @if ($errors->has('description'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div> --}}

                <div class="form-group" style="display:none">
                <label for="fee_register">@lang('main.fee_register') @lang('main.karir_train')</label>
                <input class="form-control{{ $errors->has('fee_register') ? ' is-invalid' : '' }} money" name="fee_register" id="fee_register" required value="Rp. {{ number_format($setting->fee_register) }}"/>
                @if ($errors->has('fee_register'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('fee_register') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                <label for="ocv">@lang('main.core_value')</label>
                <textarea class="form-control{{ $errors->has('ocv') ? ' is-invalid' : '' }}" name="ocv" id="ocv" required>{{ $setting->ocv }}</textarea>
                @if ($errors->has('ocv'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('ocv') }}</strong>
                        </span>
                    @endif
                </div>

                </div>
                <!-- /.box-body -->

                <!-- SEO Friendly -->
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_seo')</h3>
                </div>

                <div class="box-body">

                  <div class="form-group">
                      <label for="site_name_en">@lang('main.site_name_en')</label>

                      <textarea class="form-control{{ $errors->has('site_name_en') ? ' is-invalid' : '' }}" name="site_name_en" id="site_name_en" required>{{ $setting->site_name_en }}</textarea>

                    {{--   <input type="text" class="form-control{{ $errors->has('site_name_en') ? ' is-invalid' : '' }}" name="site_name_en" id="site_name_en" placeholder="@lang('main.site_name_en')" value="{{ $setting->site_name_en }}" required> --}}

                      @if ($errors->has('site_name_en'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('site_name_en') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="site_name_id">@lang('main.site_name_id')</label>
                      
                      <textarea class="form-control{{ $errors->has('site_name_id') ? ' is-invalid' : '' }}" name="site_name_id" id="site_name_id" required>{{ $setting->site_name_id }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('site_name_id') ? ' is-invalid' : '' }}" name="site_name_id" id="site_name_id" placeholder="@lang('main.site_name_id')" value="{{ $setting->site_name_id }}" required> --}}

                      @if ($errors->has('site_name_id'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('site_name_id') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_title_en">@lang('main.meta_title_en')</label>

                      <textarea class="form-control{{ $errors->has('meta_title_en') ? ' is-invalid' : '' }}" name="meta_title_en" id="meta_title_en" required>{{ $setting->meta_title_en }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('meta_title_en') ? ' is-invalid' : '' }}" name="meta_title_en" id="meta_title_en" placeholder="@lang('main.meta_title_en')" value="{{ $setting->meta_title_en }}" required> --}}

                      @if ($errors->has('meta_title_en'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_title_en') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_title_id">@lang('main.meta_title_id')</label>

                      <textarea class="form-control{{ $errors->has('meta_title_id') ? ' is-invalid' : '' }}" name="meta_title_id" id="meta_title_id" required>{{ $setting->meta_title_id }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('meta_title_id') ? ' is-invalid' : '' }}" name="meta_title_id" id="meta_title_id" placeholder="@lang('main.meta_title_id')" value="{{ $setting->meta_title_id }}" required> --}}

                      @if ($errors->has('meta_title_id'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_title_id') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_description_en">@lang('main.meta_description_en')</label>

                      <textarea class="form-control{{ $errors->has('meta_description_en') ? ' is-invalid' : '' }}" name="meta_description_en" id="meta_description_en" required>{{ $setting->meta_description_en }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('meta_description_en') ? ' is-invalid' : '' }}" name="meta_description_en" id="meta_description_en" placeholder="@lang('main.meta_description_en')" value="{{ $setting->meta_description_en }}" required> --}}

                      @if ($errors->has('meta_description_en'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_description_en') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_description_id">@lang('main.meta_description_id')</label>

                      <textarea class="form-control{{ $errors->has('meta_description_id') ? ' is-invalid' : '' }}" name="meta_description_id" id="meta_description_id" required>{{ $setting->meta_description_id }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('meta_description_id') ? ' is-invalid' : '' }}" name="meta_description_id" id="meta_description_id" placeholder="@lang('main.meta_description_id')" value="{{ $setting->meta_description_id }}" required> --}}

                      @if ($errors->has('meta_description_id'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_description_id') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_keyword_en">@lang('main.meta_keyword_en')</label>

                      <textarea class="form-control{{ $errors->has('meta_keyword_en') ? ' is-invalid' : '' }}" name="meta_keyword_en" id="meta_keyword_en" required>{{ $setting->meta_keyword_en }}</textarea>

                      {{-- <input type="text" class="form-control{{ $errors->has('meta_keyword_en') ? ' is-invalid' : '' }}" name="meta_keyword_en" id="meta_keyword_en" placeholder="@lang('main.meta_keyword_en')" value="{{ $setting->meta_keyword_en }}" required> --}}
                      @if ($errors->has('meta_keyword_en'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_keyword_en') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="meta_keyword_id">@lang('main.meta_keyword_id')</label>

                      <textarea class="form-control{{ $errors->has('meta_keyword_id') ? ' is-invalid' : '' }}" name="meta_keyword_id" id="meta_keyword_id" required>{{ $setting->meta_keyword_id }}</textarea>

                     {{--  <input type="text" class="form-control{{ $errors->has('meta_keyword_id') ? ' is-invalid' : '' }}" name="meta_keyword_id" id="meta_keyword_id" placeholder="@lang('main.meta_keyword_id')" value="{{ $setting->meta_keyword_id }}" required> --}}
                      @if ($errors->has('meta_keyword_id'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('meta_keyword_id') }}</strong>
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
    <script type="text/javascript">
    $('.money').maskMoney({prefix:'Rp. ', thousands:',', decimal:'.', precision:0});
    $('.decimal').maskMoney({prefix:'', thousands:',', decimal:'.', allowZero:true});
    </script>
@endsection
