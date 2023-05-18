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

                    @if (Session::has('info'))
                        <div class="alert alert-warning">{{ Session::get('info') }}</div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    
                    <table id="listTable" class="table table-bordered" width="100%">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th></th>
                        <th>Participants</th>
                        <th>Career</th>
                        <th>Jobdesk</th>
                        <th>Last Updated</th>
                        <th>Download</th>

                      </tr>
                      </thead>
                      
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th></th>
                        <th>Participants</th>
                        <th>Career</th>
                        <th>Jobdesk</th>
                        <th>Last Updated</th>
                        <th>Download</th>

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

th.dt-center, td.dt-center { text-align: center; }

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
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                {data: 'user.name', name: 'user.name'},
                {data: 'career.position_en', name: 'career.position_en'},
                {data: 'career.jobdesk_en', name: 'career.jobdesk_en'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                {"targets": [0], "visible": false},
                {"targets": [0, 1], "searchable": false, "sortable": false},
                {"targets": [1], "width": "4%"},
            ],
            "createdRow": function( row, data, dataIndex ) {
                // $(row).addClass(data['user_id']);
                $(row).attr('data-user-id', data['user_id']);
                $(row).attr('data-career-id', data['career_id']);
            }
            //"order": [ [0, 'desc'] ],
        });



        // Add event listener for opening and closing details
        $('#listTable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.api().row(tr);
     
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(row.data(), tr.attr('id'))).show();
                tr.addClass('shown');

                // Convert to Datatable
                convertTable(tr.attr('id'), tr.attr('data-user-id'), tr.attr('data-career-id'));
            }
        });
        
        loadContent(table);

    });

    function format (d, id = 0) {
        // `d` is the original data object for the row
        return '<div style="padding: 10px; border: 1px solid #ededed; border-radius: 5px;">'+
                    '<table id="childTable_'+id+'" class="table table-bordered table-striped table-child" width="100%" style="">'+
                        '<thead>'+
                            '<tr>'+
                                '<th>No</th>'+
                                '<th>Module</th>'+
                                '<th>Score</th>'+
                                '<th>Status</th>'+
                                '<th>Action</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            '<tr>'+
                                '<td>-</td>'+
                                '<td>-</td>'+
                                '<td>-</td>'+
                                '<td>-</td>'+
                                '<td>-</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>';
    }

    

    function convertTable(id = 0, user_id = 0, career_id = 0) {
        if($.fn.DataTable.isDataTable('#childTable_'+id)) $('#childTable_'+id).destroy();

        $('#childTable_'+id).dataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "autoWidth": true,
            "searching": false,
            "paging": false,
            "info": false,
            "ajax": {
                url: "{{ route('result.module.datatable') }}",
                type: 'POST',
                data: {
                    'id' : id,
                    'user_id' : user_id,
                    'career_id' : career_id,
                }
            },
            "rowId": "id",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'module.name', name: 'module.name'},
                {data: 'score', name: 'score'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                {"targets": "_all", "sortable" : false, "searchable": false},
                {"targets": [0], "visible": false},
                {"className": "dt-center", "targets": [2, 3]}
            ],
        });
    }


    function loadContent(tabled) {
        var loaded = false;

        setTimeout(function(){ 
            tabled.api().rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
            loaded = true;
        }, 300);

        setTimeout(function(){ 
            if(!loaded){
                tabled.api().rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
                loaded = true;
                
            }
        }, 500);

        setTimeout(function(){ 
            if(!loaded){
                tabled.api().rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
                loaded = true;

                
            }
        }, 1000);

        setTimeout(function(){ 
            if(!loaded){
                tabled.api().rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
                loaded = true;
            }
        }, 2000);

        setTimeout(function(){ 
            if(!loaded){
                tabled.api().rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
                loaded = true;
            }
        }, 5000);
    }

    function exporting(career_id = null, module_id = null, user_id = null) {
        
        if(career_id == null || module_id == null || user_id == null) return

        $.ajax({
            type: 'POST',
            url: '{{ route('result.export') }}',
            dataType: 'json',
            data: {career_id: career_id, module_id: module_id, user_id: user_id},
            global: false,
            async: false,
            success: function (data) {

                // console.log(data);
                // return

                var a = document.createElement("a");
                a.href = data.file; 
                a.download = data.name;
                document.body.appendChild(a);
                a.click();
                a.remove();


            },
            error: function(response) {
                console.log('Error Export : ', response);
            }
        });
    }

    function exportingCareer(career_id = null, user_id = null) {
        
        if(career_id == null || user_id == null) return

        $.ajax({
            type: 'POST',
            url: '{{ route('result.career.export') }}',
            dataType: 'json',
            data: {career_id: career_id, user_id: user_id},
            global: false,
            async: false,
            success: function (data) {

                // console.log(data);
                // return

                var a = document.createElement("a");
                a.href = data.file; 
                a.download = data.name;
                document.body.appendChild(a);
                a.click();
                a.remove();


            },
            error: function(response) {
                console.log('Error Export : ', response);
            }
        });
    }

    function exportingPdf(career_id = null, module_id = null, user_id = null) {
        
        if(career_id == null || module_id == null || user_id == null) return

        $.ajax({
            type: 'POST',
            url: '{{ route('result.export.pdf') }}',
            dataType: 'json',
            data: {career_id: career_id, module_id: module_id, user_id: user_id},
            global: false,
            async: false,
            success: function (data) {

                // console.log(data);
                // return

                // var a = document.createElement("a");
                // a.href = data.file; 
                // a.download = data.name;
                // document.body.appendChild(a);
                // a.click();
                // a.remove();


            },
            error: function(response) {
                console.log('Error Export : ', response);
            }
        });
    }
</script>
@endpush