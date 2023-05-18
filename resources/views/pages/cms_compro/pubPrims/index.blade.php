@extends('layouts.applte')

@section('content')

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
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('pubPrims')}}">Pub. PRISM</a></li>
            <li class="active">Data Pub. PRISM</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pub. PRISM </h3>
    
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
                        <th>Image</th>
                        <th>Document</th>
                        <th>Title</th>
                        <th>Info</th>
                        <th>Status</th>                        
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($posts as $post)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img src="{{ asset($post->img) }}" alt="" width="50"></td>
                        <td> <a href="{{url('/')}}/{{ $post->doc }}">Document</a></td>
                        <td>
                            
                            @if ( Session::get('language') == 'en' )
                            {{ $post->title_en }}
                            @elseif ( Session::get('language') == 'ch' )
                            {{ $post->title_in }}
                            @endif
                        </td>
                        <td>
                            @if ( Session::get('language') == 'en' )
                            {{ $post->text_en }}
                            @elseif ( Session::get('language') == 'ch' )
                            {{ $post->text_in }}
                            @endif
                        </td>
                        <td>@if($post->rowstate==1)
                              <span class="label label-primary" style="font-size: 14px">Active</span>
                            @elseif($post->rowstate==2)
                              <span class="label label-danger" style="font-size: 14px">Not Active</span>
                            @endif
                        </td>                          
                        <td>
                            <a href="{{ route('pubPrims.edit', ['id' => $post->id]) }}">
                                <i class="fa fa-edit text-blue" style="font-size: 20px"></i>
                            </a>&nbsp;
                            <a href="{{ route('pubPrims.delete', ['id' => $post->id]) }}" onclick="return confirm('Apakah anda yakin akan menghapus {{ $post->id }}?')">
                                <i class="fa fa-trash text-red" style="font-size: 20px"></i>
                            </a>
                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Document</th>
                        <th>Title</th>
                        <th>Info</th>
                        <th>Status</th>                        
                        <th>Action</th>
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