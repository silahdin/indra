@extends('layouts.applte')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('description')
});

$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Recruitment</a></li>
            <li class="active">Data Modules</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Modules</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('module.update', ['id' => Crypt::encrypt($data->id)]) }}" method="post">
                  {{ csrf_field() }}

                  <div class="box-body">

                    <div class="form-group">
                        <label for="name">Module Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $data->name }}" placeholder="Module Name"required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="scored">Scored ? <span style="color:red;">*</span></label>
                        <select class="form-control{{ $errors->has('scored') ? ' is-invalid' : '' }}" name="scored" id="scored" style="width: 100%;" required>
                            <option value="">--- Select how this module be scored</option>
                            <option value=1 {{ ($data->scored == 1) ? 'selected' : '' }}>Automated</option>
                            <option value=2 {{ ($data->scored == 2) ? 'selected' : '' }}>Automated with Marking</option>
                            <option value=3 {{ ($data->scored == 3) ? 'selected' : '' }}>Not Scored</option>
                        </select>
                        @if ($errors->has('scored'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('scored') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="minutes">Estimated Time (in Minutes)<span style="color:red;">*</span></label>
                        <input type="number" class="form-control{{ $errors->has('minutes') ? ' is-invalid' : '' }}" name="minutes" id="minutes" value="{{ @$data->minutes }}" placeholder="Estimated Time">
                        @if ($errors->has('minutes'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('minutes') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.save')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('module.index') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
