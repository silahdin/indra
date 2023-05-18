@extends('layouts.applte')

@section('content')
<!-- DataTables -->
<!-- E:\xampp\htdocs\gratama_office\public\assets\lte\bower_components\bootstrap-datepicker\dist\css -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
})
</script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
     CKEDITOR.replace('content');
    // CKEDITOR.replace('situasi');
    // CKEDITOR.replace('bantuan');
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
            <li><a href="{{ route('office')}}">Hal. Office</a></li>
            <li class="active">Data Office</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-nama">@lang('main.edit_office')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('office.detail.update', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="country_id" value="{{$dir->country_id}}" >
                  <div class="box-body">

                  @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <div class="row">
                      <div class="col-sm-12">

                        <div class="form-group">
                            <label for="cr_name1">@lang('main.category')</label>
                            <select name="category" id="category" class="form-control" required>
                                    <option value="">@lang('main.choose_category')</option>
                                    <option value="CR" @if($dir->category=="CR") selected @endif>@lang('main.chief')</option>
                                    <option value="LO" @if($dir->category=="LO") selected @endif>@lang('main.liaison')</option>
                                </select>
                            @if ($errors->has('category'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="cr_title1">@lang('main.content')</label>
                            <textarea class="form-control" required name="content" id="content">{{$dir->content}}</textarea>
                            @if ($errors->has('cr_title1'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('cr_title1') }}</strong>
                                </span>
                            @endif
                        </div>


                      </div>


                    </div>




                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <a type="button" class="btn btn-default" href="{{ route('office.detail', ['id' => $dir->country_id]) }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
