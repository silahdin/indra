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
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Setting</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="title">@lang('main.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Title" value="{{ $setting->title }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="no_tlp">No. @lang('main.telephone')</label>
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
                  <label for="alamat">@lang('main.address')</label>
                  <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="alamat" id="alamat" required>{{ $setting->alamat }}</textarea>
                  @if ($errors->has('alamat'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('alamat') }}</strong>
                          </span>
                      @endif
                  </div>

                    <div class="form-group">
                    <label for="keywords">@lang('main.keyword')</label>
                    <textarea class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" name="keywords" id="keywords" required>{{ $setting->keywords }}</textarea>
                    @if ($errors->has('keywords'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('keywords') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="description">@lang('main.description')</label>
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ $setting->description }}</textarea>
                    @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="aboutus">@lang('main.aboutus')</label>
                      <textarea class="form-control{{ $errors->has('aboutus') ? ' is-invalid' : '' }}" name="aboutus" id="aboutus" required>{{ $setting->aboutus }}</textarea>
                      @if ($errors->has('aboutus'))
                              <span class="invalid-feedback" style="color: red">
                                  <strong>{{ $errors->first('aboutus') }}</strong>
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
