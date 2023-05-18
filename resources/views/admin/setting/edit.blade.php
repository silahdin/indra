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
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Setting</li>
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
                        <label for="title">Title</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Title" value="{{ $setting->title }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="no_tlp">No. Telepon</label>
                      <input type="text" class="form-control{{ $errors->has('no_tlp') ? ' is-invalid' : '' }}" name="no_tlp" id="no_tlp" placeholder="No. Telepon" value="{{ $setting->no_tlp }}" required>
                      @if ($errors->has('no_tlp'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('no_tlp') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $setting->email }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="alamat" id="alamat" required>{{ $setting->alamat }}</textarea>
                  @if ($errors->has('alamat'))
                          <span class="invalid-feedback" style="color: red">
                              <strong>{{ $errors->first('alamat') }}</strong>
                          </span>
                      @endif
                  </div>

                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ $setting->description }}</textarea>
                    @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <textarea class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" name="keywords" id="keywords" required>{{ $setting->keywords }}</textarea>
                    @if ($errors->has('keywords'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('keywords') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                            <div class="col-xs-3">
                                <label for="client">Jumlah Client</label>
                                <input type="text" class="form-control{{ $errors->has('client') ? ' is-invalid' : '' }}" name="client" id="client" placeholder="Jumlah Client" value="{{ $setting->client }}" required>
                                @if ($errors->has('client'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-xs-4">
                                <label for="experient">Jumlah Experient</label>
                                <input type="text" class="form-control{{ $errors->has('experient') ? ' is-invalid' : '' }}" name="experient" id="experient" placeholder="Jumlah Experient" value="{{ $setting->experient }}" required>
                                @if ($errors->has('experient'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('experient') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-xs-5">
                                <label for="fast_response">Jumlah Fast Response</label>
                                <input type="text" class="form-control{{ $errors->has('fast_response') ? ' is-invalid' : '' }}" name="fast_response" id="fast_response" placeholder="Jumlah Fast Response" value="{{ $setting->fast_response }}" required>
                                @if ($errors->has('fast_response'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('fast_response') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
