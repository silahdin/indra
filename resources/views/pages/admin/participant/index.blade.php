@extends('layouts.applte')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<script src="{{ asset('assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Participants</a></li>
            <li class="active">Participants : {{ ucfirst(@$data['mode'] ?? '') }}</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Participants : {{ ucfirst(@$data['mode'] ?? '') }}</h3>
    
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
                    
                    <table id="listTable" class="table table-bordered table-striped" width="100%">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Gender</th>
                        <th>Action</th>
                      </tr>
                      </thead>

                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Gender</th>
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

@push('admin_scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#listTable').dataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,        
            "ajax": {
                url: "{{ route('participant.datatable', ['mode' => strtolower(@$data['mode'])]) }}",
                type: 'POST',
            },
            "rowId": "id",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'birthday', name: 'birthday'},
                {data: 'gender', name: 'gender'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                {"targets": [0], "visible": false},
            ],
            "order": [ [0, 'desc'] ],
        });

        $('#listTable').on('click', 'tr td button.deleteButton', function () {
            var cp = $(this).val();

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it",
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        $.ajax({
                            type: "DELETE",
                            url:  'assignment/delete/' + cp,
                            success: function (results) {
                                if(!results.status){
                                    swal("Cancelled", results.message, "warning");
                                }else{
                                    $("#"+results.data.id).remove();   
                                    swal("Deleted!", "Data has been deleted.", "success"); 
                                }
                                
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });                        
                        
                    } else {
                        swal("Cancelled", "Data is safe ", "success");
                    }
                });
        });
    } );
</script>
@endpush