@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
});
$(function () {

    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('description');
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
            <li class="active">Tambah Merk Mobil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Merk Mobil</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('merk.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="name">Nama Merk Mobil</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama Merk Mobil" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="images">Logo</label>
                        <input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images" id="images">
                        @if ($errors->has('images'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('merks') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
