@extends('layouts.applte')

@section('content')

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    //CKEDITOR.replace('editor1')
})
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
                Detail Inbox
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('inbox') }}">Bidding</a></li>
            <li class="active">{{ $inbox->mobil }}</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $inbox->mobil }} - <strong>Harga: {{ number_format($inbox->price) }} - Bidding Rp. {{ number_format($inbox->bidding) }} [<?php $selisih = $inbox->price - $inbox->bidding; echo "Selisih Rp. ".number_format($selisih); ?>]</strong></h3>
                  <br><br>
                  <img src="{{ url('/') }}/{{ $inbox->image }}" height="200px">
                  <br>
                  <small>Dari: <strong>{{ $inbox->deler }}</strong></small>
                  <br>
                  <small>{{ Carbon::parse($inbox->created_at)->format('d M Y H:i:s') }}</small>

                    <div class="mailbox-read-message">{!! $inbox->description !!}</div>

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">


              </div>

              <!-- /. box -->


                  <div class="box-header">
                    <i class="fa fa-comments-o"></i>

                    <h3 class="box-title">Balasan</h3>

                  </div>
                  <div class="box-body chat" id="chat-box">
                    <!-- chat item -->

                    @foreach($replys as $reply)
                    <div class="item">
                      <img src="../../../{{ $reply->images }}" alt="user image" class="online">

                      <p class="message">
                        <a href="#" class="name">
                          <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</small>
                          {{ $reply->name }}
                        </a>
                        {!! $reply->reply !!}
                      </p>

                      @if($reply->file)
                      <div class="attachment">
                        <h4>Attachments:</h4>

                        <p class="filename">
                          {{str_replace('uploads/bidding/', '', $reply->file)}}
                        </p>

                        <div class="pull-right">
                          <button type="button" class="btn btn-primary btn-sm btn-flat" onclick="location.href='../../../{{ $reply->file }}'">Open</button>
                        </div>
                      </div>
                      @endif

                      <!-- /.attachment -->
                    </div>
                    <!-- /.item -->
                    @endforeach


                  </div>
                  <!-- /.chat -->



              <form action="{{ route('bidding.reply', ['id' => $inbox->session_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" id="session_id" name="session_id" value="{{ $inbox->session_id }}">
              <div class="box-body">
                <?php if(Auth::user()->id != $inbox->userid) { ?>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" name="setuju" value="1" id="defaultCheck1" onclick="return confirm('Apakah anda yakin untuk setuju dengan bidding ini?')">
                        <label class="form-check-label" for="defaultCheck1">
                          Saya Setuju
                        </label>
                    </div>
                  <?php } ?>
                    <div class="form-group">
                        <label>Reply</label>
                            <textarea class="form-control" id="editor1" name="reply" rows="5" cols="80" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" id="file">
                    </div>
                  </div>
                  <div class="box-footer">
                        <div class="pull-right">
                          <button type="button" class="btn btn-default" onclick="location.href='{{ route('biddings') }}'"><i class="fa fa-backward"></i> Back</button>
                          <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>
                  </div>
                </form>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </section>
        <!-- /.content -->
      </div>
    @endsection
