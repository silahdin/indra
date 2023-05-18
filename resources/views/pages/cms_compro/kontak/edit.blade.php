@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('content_in');
    CKEDITOR.replace('content_en');
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('contact')}}">Kontak Kami</a></li>
            <li class="active">Data Kontak</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_contact')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                <form action="{{ route('contact.update') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                        <label for="content_in">@lang('main.konten_indo')</label>
                        <textarea class="form-control{{ $errors->has('content_in') ? ' is-invalid' : '' }}" name="content_in" id="content_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->content_in }}</textarea>
                        @if ($errors->has('content_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_in') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content_en">@lang('main.konten_eng')</label>
                        <textarea class="form-control{{ $errors->has('content_en') ? ' is-invalid' : '' }}" name="content_en" id="content_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->content_en }}</textarea>
                        @if ($errors->has('content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="address">Link URL Alamat Google</label>
                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="address" placeholder="ink URL Alamat Google" value="{{ $post->address }}" required>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="telp">@lang('main.no_telephone')</label>
                        <input type="text" class="form-control{{ $errors->has('telp') ? ' is-invalid' : '' }}" name="telp" id="telp" placeholder="ink URL Alamat Google" value="{{ $post->telp }}" required>
                        @if ($errors->has('telp'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('telp') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('main.karir_email')</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="ink URL Alamat Google" value="{{ $post->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>


                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
