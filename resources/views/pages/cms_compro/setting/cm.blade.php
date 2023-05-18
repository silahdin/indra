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

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<script src="https://cdn.ckeditor.com/4.11.2/standard-all/ckeditor.js"></script>
<script>
$(function () {

    CKEDITOR.replace('charimanmsg',{
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
    
        CKEDITOR.replace('charimanmsg_ch',{
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

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('setting_comp')}}">Chairman Message</a></li>
            <li class="active">Edit Setting</li>
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

                <form action="{{ route('setting_cm.update') }}" method="post"  enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
               
                <div class="form-group">
                        <label for="images_cm">@lang('main.image')'</label>
                        <img src="{{ asset($setting->logo_src) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('images_cm') ? ' is-invalid' : '' }}" name="images_cm" id="images_cm">
                        @if ($errors->has('images_cm'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images_cm') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px"><!--*Kosongkan inputan gambar jika tidak ingin mengubah gambar--></span>
                    </div>

                    <div class="form-group">
                        <label for="name_cm">@lang('main.nama')</label>
                        <input type="text" class="form-control{{ $errors->has('name_cm') ? ' is-invalid' : '' }}" name="name_cm" id="name_cm" placeholder="Name" value="{{ $setting->name_cm }}" required>
                        @if ($errors->has('name_cm'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name_cm') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_cm">@lang('main.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title_cm') ? ' is-invalid' : '' }}" name="title_cm" id="title_cm" placeholder="Title english" value="{{ $setting->title_cm }}" required>
                        @if ($errors->has('title_cm'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_cm') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title_ch">@lang('main.title_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title_ch') ? ' is-invalid' : '' }}" name="title_ch" id="title_ch" placeholder="Title chinese" value="{{ $setting->title_ch }}" required>
                        @if ($errors->has('title_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="subtitle_cm">@lang('main.subtitle_msg')</label>
                        <input type="text" class="form-control{{ $errors->has('subtitle_cm') ? ' is-invalid' : '' }}" name="subtitle_cm" id="subtitle_cm" placeholder="Sub Title english" value="{{ $setting->subtitle_cm }}" required>
                        @if ($errors->has('subtitle_cm'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('subtitle_cm') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="subtitle_cm">@lang('main.subtitle_msg_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('subtitle_ch') ? ' is-invalid' : '' }}" name="subtitle_ch" id="subtitle_ch" placeholder="Sub Title chinese" value="{{ $setting->subtitle_ch }}" required>
                        @if ($errors->has('subtitle_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('subtitle_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                <div class="form-group">
                <label for="charimanmsg">@lang('main.ChairmanMessage')</label>
                <textarea class="form-control{{ $errors->has('charimanmsg') ? ' is-invalid' : '' }}" name="charimanmsg" id="charimanmsg" required>{{ $setting->charimanmsg }}</textarea>
                @if ($errors->has('charimanmsg'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('charimanmsg') }}</strong>
                        </span>
                    @endif
                    
                    
                </div>
                
                <!--here repeat chinese-->
                <div class="form-group">
                <label for="charimanmsg_ch">@lang('main.ChairmanMessage_ch')</label>
                <textarea class="form-control{{ $errors->has('charimanmsg_ch') ? ' is-invalid' : '' }}" name="charimanmsg_ch" id="charimanmsg_ch" required>{{ $setting->charimanmsg_ch }}</textarea>
                @if ($errors->has('charimanmsg'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('charimanmsg_ch') }}</strong>
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
@endsection
