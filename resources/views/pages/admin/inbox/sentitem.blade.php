@extends('layouts.applte')

@section('content')
<?php $sekarang = Carbon::now('Asia/Jakarta'); ?>

<script src="{{ asset('assets/lte/plugins/iCheck/icheck.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/lte/plugins/iCheck/flat/blue.css') }}">
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sent Item
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sent Item</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              @if (Session::has('success'))
                  <div class="alert alert-success">{{ Session::get('success') }}</div>
              @endif

              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                      @foreach($inbox as $inb)
                  
                      @if($inb->st_inbox==0)
                      <tr style="background: #f9bb85; font-weight: bolder">
                      @else
                      <tr>
                      @endif
                    <td>
                        <a href="{{ route('inbox.delete', ['id' => Crypt::encryptString($inb->inbox_id)]) }}" onclick="return confirm('Apakah anda yakin akan menghapus {{ $inb->subject }}?')">
                            <i class="fa fa-trash text-red" style="font-size: 20px"></i>
                        </a>
                    </td>
                    <td class="mailbox-subject"><b>{{ $inb->name }}</b></td>
                    <td class="mailbox-name"><a href="read-mail.html">{{ ucfirst($inb->type) }}</a></td>
                    <td class="mailbox-name"><a href="{{ route('inbox.detail', ['id' => Crypt::encryptString($inb->inbox_id)]) }}">{{ $inb->subject }}</a>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date">{{ \Carbon\Carbon::parse($inb->created_at)->diffForHumans() }}</td>
                  </tr>
                    @endforeach

                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
                
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
@endsection