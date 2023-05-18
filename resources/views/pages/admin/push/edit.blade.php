@extends('layouts.applte')

@section('content')

<!-- bootstrap datepicker -->
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })
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
            <li class="active">Edit Push Mobil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Push Mobil</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('push.update', ['id' => Crypt::encryptString($push->push_id)]) }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="car_id">@lang('main.mobil')</label>
                          <select class="form-control{{ $errors->has('car_id') ? ' is-invalid' : '' }} select2" name="car_id" id="car_id" style="width: 100%;" required>
                              <option value="">---@lang('main.choose_mobil')</option>
                              @foreach($cars as $car)
                                  <option value="{{ $car->id }}" @if($car->id==$push->car_id) selected="selected" @endif>{{ $car->name }}</option>
                              @endforeach
                          </select>

                          @if ($errors->has('car_id'))
                              <span class="invalid-feedback" style="color: red">
                                  <strong>{{ $errors->first('car_id') }}</strong>
                              </span>
                          @endif
                      </div>

                      <?php if(Auth::user()->level == "Administrator") { ?>
                      <div class="form-group">
                        <label for="user_id">@lang('main.dealer')</label>
                          <select class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }} select2" name="user_id" id="user_id" style="width: 100%;" required>
                              <option value="">---@lang('main.choose_dealer')</option>
                              @foreach($dealers as $dealer)
                                  <option value="{{ $dealer->user_id }}" >{{ $dealer->name }}</option>
                              @endforeach
                          </select>

                          @if ($errors->has('user_id'))
                              <span class="invalid-feedback" style="color: red">
                                  <strong>{{ $errors->first('user_id') }}</strong>
                              </span>
                          @endif
                      </div>
                    <?php } else { ?>
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <?php } ?>

                      <div class="form-group">
                        <label for="to_date">@lang('main.to_date')</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                            <input type="text" name="to_date" class="form-control pull-right" id="datepicker" value="{{ $push->to_date }}" required>
                          </div>

                          @if ($errors->has('to_date'))
                              <span class="invalid-feedback" style="color: red">
                                  <strong>{{ $errors->first('to_date') }}</strong>
                              </span>
                          @endif
                      </div>

                      <?php /*
                    <div class="form-group">
                        <label for="st_push">Status</label>
                        <select class="form-control{{ $errors->has('st_push') ? ' is-invalid' : '' }}" name="st_push" id="st_push" style="width: 100%;" required>
                            <option value="">---Pilih Status Push</option>
                            <option value="1" @if($push->st_push == 1) selected="selected" @endif>Aktif</option>
                            <option value="0" @if($push->st_push == 0) selected="selected" @endif>Tidak Aktif</option>
                        </select>
                        @if ($errors->has('st_push'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_push') }}</strong>
                            </span>
                        @endif
                    </div>*/ ?>

                    <div class="form-group">
                        <label for="possition">@lang('main.posisi')</label>
                          <select class="form-control{{ $errors->has('possition') ? ' is-invalid' : '' }} select2" name="possition" id="possition" style="width: 100%;" required>
                              <option value="">---Pilih Posisi</option>
                              <option value="home"  @if($push->possition == "home") selected="selected" @endif>Home</option>
                              <option value="pencarian"  @if($push->possition == "pencarian") selected="selected" @endif>Pencarian</option>
                          </select>

                          @if ($errors->has('car_id'))
                              <span class="invalid-feedback" style="color: red">
                                  <strong>{{ $errors->first('car_id') }}</strong>
                              </span>
                          @endif
                      </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('pushs') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
