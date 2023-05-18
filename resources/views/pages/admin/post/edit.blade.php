@extends('layouts.applte')

@section('content')

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('description');
});
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>
    <?php
echo Request::segment(1);
    ?>
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Page {{ $post->title }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('page.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" id="image_old" name="image_old" value="{{ $post->images }}">
                  <div class="box-body">

                    <div class="form-group">
                        <label for="title">@lang('main.title')</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Title" value="{{ $post->title }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <img src="../../../{{ $post->images }}" height="300px">
                    </div>

                    <div class="form-group">
                        <label for="images">@lang('main.image')</label>
                        <input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images" id="images">
                        @if ($errors->has('images'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="short_desc">@lang('main.short_description')</label>
                        <textarea class="form-control{{ $errors->has('short_desc') ? ' is-invalid' : '' }}" name="short_desc" id="short_desc" required>{{ $post->short_desc }}</textarea>
                        @if ($errors->has('short_desc'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('short_desc') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">@lang('main.description')</label>
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ $post->description }}</textarea>
                            @if ($errors->has('description'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                    <div class="form-group">
                        <label for="st_post">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('st_post') ? ' is-invalid' : '' }}" name="st_post" id="st_post" style="width: 100%;" required>
                            <option value="">---@lang('main.choose_mobil_status')</option>
                            <option value="1" @if($post->st_post == 1) selected="selected" @endif>@lang('main.activity')</option>
                            <option value="0" @if($post->st_post == 0) selected="selected" @endif>@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('st_post'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_post') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('pages') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
