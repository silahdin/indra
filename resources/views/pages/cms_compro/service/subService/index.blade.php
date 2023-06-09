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
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('service')}}">Hal. Service</a></li>
            <li class="active">Data Sub Service</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Sub Service</h3>
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
                        <th>Nama</th>
                        <th>URL Slug</th>
                        <!-- <th>Deskirpsi</th>                     
                        <th>Situasi</th>                    
                        <th>Bantuan</th>                     -->
                        <th>Kontak 1</th>                    
                        <th>Kontak 2</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($services as $service)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->slug }}</td>
                        <!-- <td>{{ $service->description }}</td>
                        <td>{{ $service->situation_part}}</td>
                        <td>{{ $service->help_part}}</td> -->
                        <td><?php if($services!=""){ foreach ($contacts as $contact) {
                          if ($contact->contact_id  == $service->contact_one){ echo $contact->name;}
                        } }?></td>
                        <td><?php if($services!=""){foreach ($contacts as $contact) {
                          if ($contact->contact_id  == $service->contact_two){ echo $contact->name;}
                        } } ?></td>
                        <td>
                            <a href="{{ route('subService.edit', ['sid' => $service->service_id, 'id' => $service->sub_services_id]) }}">
                                <i class="fa fa-edit text-blue" style="font-size: 20px"></i>
                            </a>&nbsp;
                            <a href="{{ route('subService.delete', ['sid' => $service->service_id, 'id' => $service->sub_services_id]) }}" onclick="return confirm('Apakah anda yakin akan menghapus {{ $service->sub_services_id }}?')">
                                <i class="fa fa-trash text-red" style="font-size: 20px"></i>
                            </a>
                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>URL Slug</th>
                        <!-- <th>Deskirpsi</th>                     
                        <th>Situasi</th>                    
                        <th>Bantuan</th>                     -->
                        <th>Kontak 1</th>                    
                        <th>Kontak 2</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <a href="{{ route('subService.add', ['sid' => $sid]) }}">
                <button class="btn btn-primary"><i class="fa fa-plus text-white" style="font-size: 20px"></i>&nbsp;Tambah Sub Service</button>
            </a>
            <a href="{{ route('service') }}">
                <button class="btn btn-primary"><i class="fa text-white" style="font-size: 20px"></i>&nbsp;Back</button>
            </a>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection