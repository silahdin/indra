@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script type="text/javascript">
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    $(".btn-success").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
        $(this).parents(".control-group").remove();
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
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Tambah Field Mobil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Field Mobil</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('mobil.storefield', ['id' => Crypt::encryptString($mobil_id)]) }}" method="post" novalidate>
                  {{ csrf_field() }}
                  <input type="hidden" name="mobil_id" value="{{ Crypt::encryptString($mobil_id) }}">
                  <div class="box-body">

                    <div class="input-group control-group increment" >

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="name_field">Nama Field</label>
                              <input type="text" class="form-control{{ $errors->has('name_field') ? ' is-invalid' : '' }}" name="name_field[]" id="name_field" placeholder="Nama Field" value="" required>
                              @if ($errors->has('name_field'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('name_field') }}</strong>
                                    </span>
                                @endif
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="description">Keterangan Field</label>
                            <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description[]" id="description" placeholder="Keterangan Field" value="" required style="margin-right: 250px">
                            @if ($errors->has('description'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>

                        <div class="col-md-1" style="margin-top: 25px; margin-left: -32px">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>

                      </div>
                    </div>




                          <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">

                              <div class="row">

                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="name_field">Nama Field</label>
                                      <input type="text" class="form-control{{ $errors->has('name_field') ? ' is-invalid' : '' }}" name="name_field[]" id="name_field" placeholder="Nama Field" value="" required>
                                      @if ($errors->has('name_field'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('name_field') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                                </div>

                                <div class="col-sm-5" style="margin-right: 26px;">
                                  <div class="form-group">
                                    <label for="description">Keterangan Field</label>
                                    <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description[]" id="description" placeholder="Keterangan Field" value="" required style="margin-right: 195px">
                                    @if ($errors->has('description'))
                                          <span class="invalid-feedback" style="color: red">
                                              <strong>{{ $errors->first('description') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                </div>

                                <div class="col-sm-1" style="margin-top: 25px; margin-left: -30px;">
                                  <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>



                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href='javascript:history.back()'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
