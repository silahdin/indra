@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Recruitment</a></li>
            <li class="active">Data Step</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Step</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('step.update', ['id' => Crypt::encrypt($data->id)]) }}" method="post">
                  {{ csrf_field() }}

                  <div class="box-body">

                    <div class="form-group">
                        <label for="module_id">Module<span style="color:red;">*</span></label>
                        <select class="form-control{{ $errors->has('module_id') ? ' is-invalid' : '' }}" name="module_id" id="module_id" style="width: 100%;" >
                        </select>
                        @if ($errors->has('module_id'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('module_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Step Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $data->name }}" placeholder="Step Name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="order">Order<span style="color:red;">*</span></label>
                        <input type="number" class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}" name="order" id="order" value="{{ $data->order }}" placeholder="Step Order">
                        @if ($errors->has('order'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('order') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.save')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('step.index') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection

@push('admin_scripts')

<script>
$(document).ready( function () {

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#module_id').select2(setOptions('{{ route("module.data") }}', '-- Choose Module --', function (params) {return filterData('q', params.term);
      }, function (data, params) {
          return {
              results: $.map(data, function (obj) {                                
                  return {id: obj.id, text: obj.name}
              })
          }
      }));

  init();
});

$(function () {
    CKEDITOR.replace('description')
});

$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
});

function init() {
    $('#module_id').select2("trigger", "select", {
        data: { id: '{{ $data->module_id }}', text: '{{ $data->module->name }}'}
    });

    $('#module_id, :focus,input').prop('focus',false).blur();
}
</script>

@endpush
