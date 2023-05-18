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
            <li><a href="#">Access Control List</a></li>
            <li class="active">Data User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit User {{ $user->name }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('user.update', ['id' => Crypt::encrypt($user->id)]) }}" method="post">
                  {{ csrf_field() }}

                  <div class="box-body">

                    <div class="form-group">
                        <label for="first_name">@lang('main.first_name') <span style="color:red;">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ $user->first_name }}" placeholder="First Name"required>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="last_name">@lang('main.last_name')</label>
                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="Last Name">
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="birthday">@lang('main.birthdate')</label>
                        <div class="input-group date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" data-provide="datepicker" >
                            <input  maxlength="10" class="form-control " size="10" type="text" name="birthday" id="birthday" placeholder="Contoh, 11-08-2012" value="{{ \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') }}" >
                            <span class="input-group-addon" title='klik ini untuk mempermudah input tanggal'><span class="glyphicon glyphicon-calendar" ></span></span>
                        </div>

                        @if ($errors->has('birthday'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="gender">@lang('main.gender') <span style="color:red;">*</span></label>
                        <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="gender" style="width: 100%;" required>
                            <option value="">---@lang('main.choose_user_gender')</option>
                            <option value="male" {{ ($user->gender == 'male') ? 'selected' : '' }}>@lang('main.male')</option>
                            <option value="female" {{ ($user->gender == 'female') ? 'selected' : '' }}>@lang('main.female')</option>
                        </select>
                        @if ($errors->has('gender'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('main.karir_email')</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">@lang('main.password')</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" value="">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="level">@lang('main.level')</label>
                        <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" id="level" style="width: 100%;" required>
                            <option value="">---@lang('main.choose_user')</option>
                            <option value="Admin" @if($user->level=="Admin") selected @endif>Administrator</option>
                            <option value="user" @if($user->level=="user") selected @endif>Member</option>
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
                            <option value="">---@lang('main.choose_dealer_status')</option>
                            <option value="1" @if($user->st_user==1) selected @endif>@lang('main.activity')</option>
                            <option value="0" @if($user->st_user==0) selected @endif>@lang('main.non_activity')</option>
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
                    <button type="submit" class="btn btn-primary">@lang('main.save')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('users') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
