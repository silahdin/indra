@extends('layouts.applte')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Recruitment</a></li>
            <li class="active">Result Recruitment</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Result Recruitment</h3>
    
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
                    
                    <table id="listTable" class="table table-bordered" width="100%">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Participants</th>
                        <th>Career</th>

                      </tr>
                      </thead>
                      
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Participants</th>
                        <th>Career</th>

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

@push('admin_styles')
<style type="text/css">
td.details-control {
    position: relative;
    cursor: pointer;
}

td.details-control:before{
    content: "\f055";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: FontAwesome;
    position:absolute;
    color: green;
    font-size: 16px;
    left: 12px;
    top: 6px;
}

tr.shown td.details-control:before {
    content: "\f056";  /* this is your text. You can also use UTF-8 character codes as I do here */
    color: red;
}
</style>
@endpush

@push('admin_scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#listTable').dataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,        
            "ajax": {
                url: "{{ route('result.datatable') }}",
                type: 'POST',
            },
            "rowId": "id",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'user.name', name: 'user.name'},
                {data: 'career.position_en', name: 'career.position_en'},
            ],
            "columnDefs": [
                {"targets": [0], "visible": false},
            ],
            //"order": [ [0, 'desc'] ],
        });


    });

    

</script>
@endpush