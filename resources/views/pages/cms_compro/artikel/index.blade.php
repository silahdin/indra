
@extends('layouts.applte')

@section('content')
<?php  
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
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('article')}}">Hal. Bertia/Artikel</a></li>
            <li class="active">Data Bertia/Artikel</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('main.news_article_data') </h3>
    
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

                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif                    
                    
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; 
                          $lang_org = session('language');
                          ?>
                          @foreach($posts as $post)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img src="{{ asset($post->img_head) }}" width="90"></td>
                        <td>
                            
                            <?php 
                             if($lang_org=='en')
                             {
                              echo $post->title_en;
                              }
                             else
                              {
                               echo $post->title_in;
                               }
                                    			    
                              ?>
                        </td>
                        <td>
                            
                            <?php 
                             if($lang_org=='en')
                             {
                              echo shorter($post->content_en);
                              }
                             else
                              {
                               echo shorter($post->content_in);
                               }
                                    			    
                              ?>
                        </td>
                        <td>
                            {{ $post->name_in }}
                            <?php 
                             if($lang_org=='en')
                             {
                              echo $post->name_en;
                              }
                             else
                              {
                               echo $post->name_in;
                               }
                                    			    
                              ?>
                        </td>
                        <td>@if($post->rowstate==1)
                              <span class="label label-primary" style="font-size: 14px">Active</span>
                            @elseif($post->rowstate==2)
                              <span class="label label-danger" style="font-size: 14px">Not Active</span>
                            @endif
                        </td>                        
                        <td>
                            <a href="{{ route('article.edit', ['id' => $post->article_id]) }}">
                                <i class="fa fa-edit text-blue" style="font-size: 20px"></i>
                            </a>&nbsp;
                            <a href="{{ route('article.delete', ['id' => $post->article_id]) }}" onclick="return confirm('Are you sure you want to delete? {{ $post->title_in }}?')">
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
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
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