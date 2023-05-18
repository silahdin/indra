@extends('layouts.applte')

@section('content')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<script src="{{ asset('assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function () {
    $('#example1').DataTable({
      'pageLength'  : 50
    })
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'pageLength'  : 50,
    })
})
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Peserta</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{$titles}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Position</th>
                        <th>Jobdesk</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($users as $d)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $d->position }}</td>
                        <td>{{ $d->jobdesk_in }}</td>
                        <td>{{ $d->position }}</td>
                        <td>{{$d->date_start}}</td>
                        <td>{{$d->date_end}}</td>
                        <td>
                            <a href="{{ route('loker.detail', ['id' => Crypt::encryptString($d->id)]) }}">
                                <i class="fa fa-folder-open text-blue" style="font-size: 20px"></i>
                            </a>          
                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Position</th>
                        <th>Jobdesk</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
            
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
