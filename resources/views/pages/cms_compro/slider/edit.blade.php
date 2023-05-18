@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('aboutus')
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('slider')}}">Slider</a></li>
            <li class="active">Edit Slider</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_slider')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('slider.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="background">@lang('main.image_back')</label>
                        <img src="{{ asset($post->background) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('background') ? ' is-invalid' : '' }}" name="background" id="background">
                        @if ($errors->has('background'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('background') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                    </div>

                    <div class="form-group">
                        <label for="img_left">@lang('main.image_left')</label>
                        <img src="{{ asset($post->img_left) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('img_left') ? ' is-invalid' : '' }}" name="img_left" id="img_left">
                        @if ($errors->has('img_left'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_left') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                    </div>

                    <div class="form-group">
                        <label for="img_middle">@lang('main.image_middle')</label>
                        <img src="{{ asset($post->img_middle) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('img_middle') ? ' is-invalid' : '' }}" name="img_middle" id="img_middle">
                        @if ($errors->has('img_middle'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_middle') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                    </div>


                    <div class="form-group">
                        <label for="img_line">@lang('main.image_line')</label>
                        <img src="{{ asset($post->img_line) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('img_line') ? ' is-invalid' : '' }}" name="img_line" id="img_line">
                        @if ($errors->has('img_line'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_line') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                    </div>

                    <div class="form-group">
                        <label for="img_right">@lang('main.image_right')</label>
                        <img src="{{ asset($post->img_right) }}" alt="" width="200" style="padding: 5px; border: dotted #faf 1px; display: block; margin-bottom: 5px">
                        <input type="file" class="form-control{{ $errors->has('img_right') ? ' is-invalid' : '' }}" name="img_right" id="img_right">
                        @if ($errors->has('img_right'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_right') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
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
                    <a href="{{ route('slider') }}" class="btn btn-default">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
