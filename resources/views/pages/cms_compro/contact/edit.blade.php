@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('address_in');
    CKEDITOR.replace('address_en');
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
                  <h3 class="box-title">Edit Data Kontak</h3>
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
                        <label for="title_in">@lang('main.judul_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title_in') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Judul Indonesia" value="{{ $post->title_in }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">@lang('main.judul_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Judul English" value="{{ $post->title_en }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="text_in">@lang('main.text_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('text_in') ? ' is-invalid' : '' }}" name="text_in" id="text_in" placeholder="Text Indonesia" value="{{ $post->text_in }}" required>
                        @if ($errors->has('text_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text_en">@lang('main.text_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('text_en') ? ' is-invalid' : '' }}" name="text_en" id="text_en" placeholder="Text English" value="{{ $post->text_en }}" required>
                        @if ($errors->has('text_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_en') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="address_in">@lang('main.alamat_indo')</label>
                        <textarea class="form-control{{ $errors->has('address_in') ? ' is-invalid' : '' }}" name="address_in" id="address_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->address_in }}</textarea>
                        @if ($errors->has('address_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('address_in') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address_en">@lang('main.alamat_eng')</label>
                        <textarea class="form-control{{ $errors->has('address_en') ? ' is-invalid' : '' }}" name="address_en" id="address_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->address_en }}</textarea>
                        @if ($errors->has('address_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('address_en') }}</strong>
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
