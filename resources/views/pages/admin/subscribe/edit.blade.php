@extends('layouts.applte')

@section('content')

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
                  <h3 class="box-title">Edit Subscribe {{ $subscribe->email }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('subscribe.update', ['id' => Crypt::encryptString($subscribe->subscribe_id)]) }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="email">@lang('main.karir_email')</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $subscribe->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="st_subscribe">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('st_subscribe') ? ' is-invalid' : '' }}" name="st_subscribe" id="st_subscribe" style="width: 100%;" required>
                            <option value="">---@lang('main.karir_choose_status')</option>
                            <option value="1" @if($subscribe->st_subscribe == 1) selected="selected" @endif>@lang('main.activity')</option>
                            <option value="0" @if($subscribe->st_subscribe == 0) selected="selected" @endif>@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('st_subscribe'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_subscribe') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('subscribes') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
