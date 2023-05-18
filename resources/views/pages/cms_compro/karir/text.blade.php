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
    CKEDITOR.replace('careerText');
});
</script>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('main.sidebar_home')</a></li>
            <li><a href="{{ route('career')}}">@lang('main.sidebar_karir')</a></li>
            <li class="active">Setting Text</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Setting Text</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('career.text.post') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">




                  
                    

                    <div class="form-group">
                        <label for="careerText">Text</label>
                        <textarea class="form-control{{ $errors->has('careerText') ? ' is-invalid' : '' }}" name="careerText" id="careerText"  cols="5" rows="2" required>{!! @$post->text !!}</textarea>
                        @if ($errors->has('careerText'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('careerText') }}</strong>
                            </span>
                        @endif
                    </div>

                                     

                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection