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
            <li><a href="{{ route('inbox') }}">Inbox</a></li>
            <li class="active">{{ $inbox->subject }}</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $inbox->subject }}</h3>
                  <br>
                  <small>Dari: <strong>{{ $inbox->name }}</strong></small>
                  <br>
                  <small>{{ Carbon::parse($inbox->created_at)->format('d M Y H:i:s') }}</small>
    
                    <div class="mailbox-read-message">{!! $inbox->content !!}</div>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  
                  
              </div>

              @if($inbox->file)
              <div class="box-footer">
                <ul class="mailbox-attachments clearfix">
                  <li>
                    <span class="mailbox-attachment-icon"><i class="fa fa-paperclip"></i></span>   
    
                    <div class="mailbox-attachment-info">
                      &nbsp;{{ $inbox->file }}
                            <a href="{{ $inbox->file }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                    </div>
                  </li>
                </ul>
              </div>
              @endif
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
                          {{str_replace('uploads/inbox/', '', $reply->file)}}
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
               


              <form action="{{ route('inbox.reply', ['id' => $inbox->inbox_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" id="id" name="id" value="{{ $inbox->inbox_id }}">
              <div class="box-body">
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
                          <button type="button" class="btn btn-default" onclick="window.history.back()"><i class="fa fa-backward"></i> Back</button>
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