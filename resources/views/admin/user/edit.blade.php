@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit User</li>
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
                <form action="{{ route('user.update', ['id' => Crypt::encryptString($user->id)]) }}" method="post">
                  {{ csrf_field() }}

                  <div class="box-body">

                    <div class="form-group">
                        <label for="sub_kategori">Nama User</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama User" value="{{ $user->name }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $user->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" value="">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="cabang_id">Cabang</label>
                        <select class="form-control{{ $errors->has('cabang_id') ? ' is-invalid' : '' }} select2" name="cabang_id" id="cabang_id" style="width: 100%;" required>
                            <option value="">---Pilih Cabang</option>
                            <?php 
                            $cabangs = DB::table('cabang')
                            ->where('st_cabang', 1)
                            ->orderBy('name_cabang', 'ASC')
                            ->get();
                            ?>
                            @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->cabang_id }}" @if($user->cabang_id==$cabang->cabang_id) selected @endif>{{ $cabang->name_cabang }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('cabang_id'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('cabang_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" id="level" style="width: 100%;" required>
                            <option value="">---Pilih Level User</option>
                            <option value="Administrator" @if($user->level=="Administrator") selected @endif>Super Administrator</option>
                            <option value="Admin" @if($user->level=="Admin") selected @endif>Administrator</option>
                            <option value="Dealer" @if($user->level=="Dealer") selected @endif>Dealer</option>
                        </select>
                        @if ($errors->has('level'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="st_user">Status</label>
                        <select class="form-control{{ $errors->has('st_user') ? ' is-invalid' : '' }}" name="st_user" id="st_user" style="width: 100%;" required>
                            <option value="">---Pilih Status Dealer</option>
                            <option value="1" @if($user->st_user==1) selected @endif>Aktif</option>
                            <option value="0" @if($user->st_user==0) selected @endif>Tidak Aktif</option>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('users') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
