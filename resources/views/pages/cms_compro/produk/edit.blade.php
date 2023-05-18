@extends('layouts.applte')

@section('content')

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
            <li><a href="{{ route('produk')}}">Produk</a></li>
            <li class="active">Edit Data Produk</li>
          </ol>
        </section>

<?php
// print_r($post);
?>
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('main.edit_product') {{ $post->title_in }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('produk.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="img_icon">@lang('main.gambar_icon')</label>
                        <input type="file" class="form-control{{ $errors->has('img_icon') ? ' is-invalid' : '' }}" name="img_icon" id="img_icon">
                        @if ($errors->has('img_icon'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_icon') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*@lang('main.image_detail')</span>
                    </div>

                    <div class="form-group">
                        <label for="title_in">@lang('main.title_indo')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Title Indonesia" value="{{ $post->title_in }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">@lang('main.title_eng')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Title English" value="{{ $post->title_en }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description_in">@lang('main.des_indo')</label>
                        <textarea class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="description_in" id="description_in" placeholder="Deskripsi Indonesia"  cols="5" rows="2" required>{{ $post->description_in }}</textarea>
                        <!-- <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="description_in" id="description_in" placeholder="Deskripsi Indonesia" value="{{ $post->description_in }}" required> -->
                        @if ($errors->has('description_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description_en">@lang('main.des_eng')</label>
                        <textarea class="form-control{{ $errors->has('description_en') ? ' is-invalid' : '' }}" name="description_en" id="description_en" placeholder="Deskripsi English"  cols="5" rows="2" required>{{ $post->description_en }}</textarea>
                        @if ($errors->has('description_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description_en') }}</strong>
                            </span>
                        @endif
                    </div>

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

                        <!-- <input type="text" class="form-control{{ $errors->has('content_en') ? ' is-invalid' : '' }}" name="content_en" id="content_en" placeholder="Konten English" value="{{ $post->content_en }}" required> -->
                        @if ($errors->has('content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_en') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="rowstate">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate" id="rowstate" style="width: 100%;" required>
                            <option value="">--@lang('main.choose_product')--</option>
                            <option value="1" @if($post->rowstate==1) selected @endif>@lang('main.activity')</option>
                            <option value="2" @if($post->rowstate==2) selected @endif>@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('rowstate'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('rowstate') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('produk') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
