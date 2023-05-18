@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

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
    CKEDITOR.replace('question');
    CKEDITOR.replace('answer');
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
            <li class="active">Data FAQ</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit FAQ</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('faq.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="group_id">Group</label>
                        <select class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}" name="group_id" id="group_id" style="width: 100%;" required>
                        </select>
                        @if ($errors->has('group_id'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('group_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="question" placeholder="Kualifikasi English"  cols="5" rows="2" required>{!! @$post->question !!}</textarea>
                        @if ($errors->has('question'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" id="answer" placeholder="Kualifikasi English"  cols="5" rows="2" required>{!! @$post->answer !!}</textarea>
                        @if ($errors->has('answer'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-default" href="{{ route('faq') }}">@lang('main.cancel')</a>
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

  $('#group_id').select2(setOptions('{{ route("faq.group.data") }}', '-- Choose Group --', function (params) {return filterData('q', params.term);
  }, function (data, params) {
      return {
          results: $.map(data, function (obj) { 
            console.log(obj);                               
              return {id: obj.id, text: obj.group}
          })
      }
  }));

  init();

});

function init() {
    $('#group_id').select2("trigger", "select", {
        data: { id: '{{ $post->group_id }}', text: '{{ $post->group_name }}'}
    });

    $('#group_id, :focus,input').prop('focus',false).blur();
}
</script>

@endpush