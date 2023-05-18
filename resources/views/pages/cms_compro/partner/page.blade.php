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

                <form action="{{ route('beranda.editpage') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="title_in">Judul Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('title_in') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Judul Indonesia" value="{{ $post->title_in }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">Judul English</label>
                        <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Judul English" value="{{ $post->title_en }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>




                    <div class="form-group">
                        <label for="titleh2_in">Judul H2 Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('titleh2_in') ? ' is-invalid' : '' }}" name="titleh2_in" id="titleh2_in" placeholder="Judul H2 Indonesia" value="{{ $post->titleh2_in }}" required>
                        @if ($errors->has('titleh2_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('titleh2_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="titleh2_en">Judul H2 English</label>
                        <input type="text" class="form-control{{ $errors->has('titleh2_en') ? ' is-invalid' : '' }}" name="titleh2_en" id="titleh2_en" placeholder="Judul H2 English" value="{{ $post->titleh2_en }}" required>
                        @if ($errors->has('titleh2_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('titleh2_en') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="texth2_in">Text H2 Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('texth2_in') ? ' is-invalid' : '' }}" name="texth2_in" id="texth2_in" placeholder="Text H2 Indonesia" value="{{ $post->texth2_in }}" required>
                        @if ($errors->has('texth2_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('texth2_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="texth2_en">Text H2 English</label>
                        <input type="text" class="form-control{{ $errors->has('texth2_en') ? ' is-invalid' : '' }}" name="texth2_en" id="texth2_en" placeholder="Text H2 English" value="{{ $post->texth2_en }}" required>
                        @if ($errors->has('texth2_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('texth2_en') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label for="partner_in">Judul Partner Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('partner_in') ? ' is-invalid' : '' }}" name="partner_in" id="partner_in" placeholder="Judul Partner Indonesia" value="{{ $post->partner_in }}" required>
                        @if ($errors->has('partner_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('partner_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="partner_en">Judul Partner English</label>
                        <input type="text" class="form-control{{ $errors->has('partner_en') ? ' is-invalid' : '' }}" name="partner_en" id="partner_en" placeholder="Judul H3 English" value="{{ $post->partner_en }}" required>
                        @if ($errors->has('partner_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('partner_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_in">Judul Subscribe Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('sub_in') ? ' is-invalid' : '' }}" name="sub_in" id="sub_in" placeholder="Judul Subscribe Indonesia" value="{{ $post->sub_in }}" required>
                        @if ($errors->has('sub_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('sub_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_en">Judul Subscribe English</label>
                        <input type="text" class="form-control{{ $errors->has('sub_en') ? ' is-invalid' : '' }}" name="sub_en" id="sub_en" placeholder="Judul Subscribe English" value="{{ $post->sub_en }}" required>
                        @if ($errors->has('sub_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('sub_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="textsub_in">Text Subscribe Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('textsub_in') ? ' is-invalid' : '' }}" name="textsub_in" id="textsub_in" placeholder="Text Subscribe Indonesia" value="{{ $post->textsub_in }}" required>
                        @if ($errors->has('textsub_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('textsub_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="textsub_en">Text Subscribe English</label>
                        <input type="text" class="form-control{{ $errors->has('textsub_en') ? ' is-invalid' : '' }}" name="textsub_en" id="textsub_en" placeholder="Text Subscribe English" value="{{ $post->textsub_en }}" required>
                        @if ($errors->has('textsub_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('textsub_en') }}</strong>
                            </span>
                        @endif
                    </div>




                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
