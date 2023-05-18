@extends('layouts.applte')

@section('content')

<?php
function dateUser($date){
return date("d-m-Y", strtotime($date) );
}
function shorter($string){
  if (strlen($string) >= 80) {
    return substr($string, 0, 90). " ... ";
  }
  else {
    return $string;
  }
}
?>

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<script src="{{ asset('assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
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
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('main.sidebar_home')</a></li>
            <li><a href="javascript:void(0);">Front Page</a></li>
            <li class="active">Data Slider</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Landing Page Slider</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i>
                </button>
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
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Brief</th>
                        <th>Link Text</th>
                        <th>Link URL</th>
                        <th>Link Open</th>
                        <th>Image</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($posts as $post)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->sub_title }}</td>
                        <td>{!! $post->brief !!}</td>
                        <td>{{ $post->link_text }}</td>
                        <td>{{ $post->link_url }}</td>
                        <td>{{ ($post->link_open == 0) ? 'Same Page' : 'New Page' }}</td>
                        <td><img src="{{ asset($post->image_url) }}" alt="" width="90"></td>
                        <td>{{ ($post->status == 0) ? 'Not Active' : 'Active' }}</td>
                        <td>
                            <a href="{{ route('landing.slider.edit', ['id' => $post->id]) }}">
                                <i class="fa fa-edit text-blue" style="font-size: 20px"></i>
                            </a>&nbsp;
                            <a href="{{ route('landing.slider.delete', ['id' => $post->id]) }}" onclick="return confirm('Apakah anda yakin akan menghapus data?')">
                                <i class="fa fa-trash text-red" style="font-size: 20px"></i>
                            </a>
                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Brief</th>
                        <th>Link Text</th>
                        <th>Link URL</th>
                        <th>Link Open</th>
                        <th>Image</th>
                        <th>Status</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
            <!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
