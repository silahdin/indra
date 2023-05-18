@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

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

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })

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
            <li class="active">Tambah Dealer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Dealer</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('jaringan.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="sub_kategori">Nama Dealer</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama Dealer" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address" placeholder="Alamat" required>{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kotamadya_id">Kotamadya</label>
                        <select class="form-control{{ $errors->has('kotamadya_id') ? ' is-invalid' : '' }} select2" name="kotamadya_id" id="kotamadya_id" style="width: 100%;" required>
                            <option value="">Pilih Kotamadya</option>
                            @foreach($kotas as $kota)
                              <option value="{{ $kota->kotamadya_id }}">{{ $kota->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="phone">Telepon</label>
                    <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} numbersOnly" name="phone" id="phone" placeholder="Telepon" value="{{ old('phone') }}" required>
                    @if ($errors->has('price'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images" id="images">
                        @if ($errors->has('images'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" id="level" style="width: 100%;" required>
                            <option value="Dealer">Dealer</option>
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="level">End Contract</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="contract_date" value="{{ old('contract_date') }}" required>
                      </div>
                      <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label for="st_user">Status</label>
                        <select class="form-control{{ $errors->has('st_user') ? ' is-invalid' : '' }}" name="st_user" id="st_user" style="width: 100%;" required>
                            <option value="">---Pilih Status Dealer</option>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        @if ($errors->has('st_user'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_user') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('dealers') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
