@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('aboutus')
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Detail Karir/Loker</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detail Karir/Loker <strong>{{$position}}</strong></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('loker.update', ['id' => $id]) }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">


                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Remarks</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $listjobs = DB::table('tbl_test')
                                    ->orderBy('name', 'ASC')
                                    ->get();
                                    /*$listjobs = DB::table('tbl_list_test_job')
                                    ->select('tbl_list_test_job.id_list', 'tbl_test.id_test', 'tbl_test.name')
                                    ->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
                                    ->where('id_career', $id)
                                    ->orderBy('id_list', 'ASC')
                                    ->get();*/
                                    ?>
                                    @foreach($listjobs as $d)

                                    <?php 
                                    $listtest = DB::table('tbl_list_test_job')
                                    ->where('id_career', $id)
                                    ->where('id_test', $d->id_test)
                                    ->first();
                                    ?>
                                <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $d->name }}</td>
                                  <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="{{ $d->id_test }}" name="id_test[]" @if($listtest) checked @endif>
                                            </label>
                                        </div>         
                                  </td>
                                </tr>
                                    @endforeach
                                </tbody>
                              </table>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('lokers') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
