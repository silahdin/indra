@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script src="https://cdn.ckeditor.com/4.11.2/standard-all/ckeditor.js"></script>
<script>
$(function () {

    CKEDITOR.replace('ocv',{
        extraPlugins: 'embed,autoembed,image2',
        height: 200,
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
    
        CKEDITOR.replace('ocv_ch',{
        extraPlugins: 'embed,autoembed,image2',
        height: 200,
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
                  <h3 class="box-title">@lang('main.sidebar_setting')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('setting_ocv.update') }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">
               

                <div class="form-group">
                <label for="ocv">@lang('main.core_value_en')</label>
                <textarea class="form-control{{ $errors->has('ocv') ? ' is-invalid' : '' }}" name="ocv" id="ocv" required>{{ $setting->ocv }}</textarea>
                @if ($errors->has('ocv'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('ocv') }}</strong>
                        </span>
                    @endif
                </div>

                </div>
                
                
                
                  <div class="box-body">
               

                <div class="form-group">
                <label for="ocv">@lang('main.core_value_ch')</label>
                <textarea class="form-control{{ $errors->has('ocv') ? ' is-invalid' : '' }}" name="ocv_ch" id="ocv_ch" required>{{ $setting->ocv_ch }}</textarea>
                @if ($errors->has('ocv'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('ocv_ch') }}</strong>
                        </span>
                    @endif
                </div>

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
    <script type="text/javascript">
    $('.money').maskMoney({prefix:'Rp. ', thousands:',', decimal:'.', precision:0});    
    $('.decimal').maskMoney({prefix:'', thousands:',', decimal:'.', allowZero:true});
    </script> 
@endsection
