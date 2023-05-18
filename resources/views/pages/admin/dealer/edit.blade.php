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
            <li class="active">Edit Dealer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Dealer - {{ $dealer->name }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('dealer.update', ['id' => Crypt::encryptString($dealer->user_id)]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="image_old" id="image_old" value="{{ $dealer->images }}">
                  <div class="box-body">

                    <div class="form-group">
                        <label for="sub_kategori">Nama Dealer</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama Dealer" value="{{ $dealer->name }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('main.karir_email')</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $dealer->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">@lang('main.password')</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" value="" >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="address">@lang('main.address')</label>
                    <textarea class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address" placeholder="Alamat" required>{{ $dealer->address }}</textarea>
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
                              <option value="{{ $kota->kotamadya_id }}" @if($dealer->kotamadya_id==$kota->kotamadya_id) selected @endif>{{ $kota->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="phone">@lang('main.telephone')</label>
                    <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} numbersOnly" name="phone" id="phone" placeholder="Telepon" value="{{ $dealer->phone }}" required>
                    @if ($errors->has('price'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <img src="{{ url('/') }}/{{ $dealer->images }}" height="300px">
                    </div>

                    <div class="form-group">
                        <label for="images">@lang('main.image')</label>
                        <input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images" id="images">
                        @if ($errors->has('images'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="level">@lang('main.end_contract')</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="contract_date" value="{{ $dealer->contract_date }}">
                      </div>
                      <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label for="level">@lang('main.level')</label>
                        <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" id="level" style="width: 100%;" required>
                            <option value="Dealer" @if($dealer->level=="Dealer") selected @endif>Dealer</option>
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="st_user">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('st_user') ? ' is-invalid' : '' }}" name="st_user" id="st_user" style="width: 100%;" required>
                            <option value="">---Pilih Status Dealer</option>
                            <option value="1" @if($dealer->st_user==1) selected @endif>Aktif</option>
                            <option value="0" @if($dealer->st_user==0) selected @endif>Tidak Aktif</option>
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
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('dealers') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
