@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('vision_in');
    CKEDITOR.replace('vision_en');
    CKEDITOR.replace('mission_in');
    CKEDITOR.replace('mission_en');
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('about')}}">Tentang Perusahaan</a></li>
            <li class="active">Data Visi Misi</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_vi_mi')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('vision.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                        <label for="vision_in">@lang('main.vision_indo')</label>
                        <textarea class="form-control{{ $errors->has('vision_in') ? ' is-invalid' : '' }}" name="vision_in" id="vision_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->vision_in }}</textarea>
                        @if ($errors->has('vision_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('vision_in') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="vision_en">@lang('main.vision_eng')</label>
                        <textarea class="form-control{{ $errors->has('vision_en') ? ' is-invalid' : '' }}" name="vision_en" id="vision_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->vision_en }}</textarea>
                        @if ($errors->has('vision_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('vision_en') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="mission_in">@lang('main.mission_indo')</label>
                        <textarea class="form-control{{ $errors->has('mission_in') ? ' is-invalid' : '' }}" name="mission_in" id="mission_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->mission_in }}</textarea>
                        @if ($errors->has('mission_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('mission_in') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="mission_en">@lang('main.mission_eng')</label>
                        <textarea class="form-control{{ $errors->has('mission_en') ? ' is-invalid' : '' }}" name="mission_en" id="mission_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->mission_en }}</textarea>
                        @if ($errors->has('mission_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('mission_en') }}</strong>
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
