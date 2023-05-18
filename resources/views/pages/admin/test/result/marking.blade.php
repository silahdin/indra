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
            <li><a href="#">Recruitment</a></li>
            <li class="active">Marking Answer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Marking Answer</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('result.marking.post') }}" method="post">
                  {{ csrf_field() }}

                  <input type="hidden" name="result_id" value="{{ Crypt::encrypt(@$result->id) }}">

                  <div class="box-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table style="width: 50%;" class="table table-striped table-bordered">
                      <tr>
                        <td width="25%" style="font-weight: bold;">Participant</td>
                        <td width="5%">:</td>
                        <td>{{ @$result->user->name }}</td>
                      </tr>
                      <tr>
                        <td style="font-weight: bold;">Career</td>
                        <td>:</td>
                        <td>{{ @$result->career->position_en }}</td>
                      </tr>
                      <tr>
                        <td style="font-weight: bold;">Module</td>
                        <td>:</td>
                        <td>{{ @$result->module->name }}</td>
                      </tr>
                    </table>

                    <div style="padding-top: 10px;"></div>

                    <h4>Participants Answer</h4>

                    <div style="padding-bottom: 10px;"></div>

                    <table id="answerTable" class="table table-striped table-bordered display nowrap" width="100%">
                      <thead>
                        <tr>
                          <th>Question</th>
                          <th>Answer</th>
                          <th>Explanation</th>
                          <th>Score</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach(@$data ?? [] as $item)
                        <tr>
                          <td>{!! @$item['question'] !!}</td>
                          <td>{!! @$item['answer'] !!}</td>
                          <td>{!! @$item['explanation'] !!}</td>
                          <td>
                            <input type="number" name="{{ $item['code'] }}" value="{{ @$item['score'] }}" placeholder="Input Score" class="form-control">
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('result.index') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection

@push('admin_scripts')
<script type="text/javascript">
    $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#answerTable').dataTable({
          "scrollX": true,
          "paging": false,
          "info": false,
          "searching": false,
          "autoWidth": true,
          "ordering": false,
      });
    });
</script>
@endpush
