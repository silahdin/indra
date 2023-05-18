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
            <li><a href="{{ route('slider')}}">Slider</a></li>
            <li class="active">Tambah Data Slider</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Slider</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="text1_in">Text 1 Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text1_in') ? ' is-invalid' : '' }}" name="text1_in" id="text1_in" placeholder="Text 1 Indonesia" value="{{ old('text1_in') }}" required>
                        @if ($errors->has('text1_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text1_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text1_en">Text 1 English</label>
                        <input type="text" class="form-control{{ $errors->has('text1_en') ? ' is-invalid' : '' }}" name="text1_en" id="text1_en" placeholder="Text 1 English" value="{{ old('text1_en') }}" required>
                        @if ($errors->has('text1_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text1_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text2_top_in">Text 2 Top Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text2_top_in') ? ' is-invalid' : '' }}" name="text2_top_in" id="text2_top_in" placeholder="Text 2 Top Indonesia" value="{{ old('text2_top_in') }}" required>
                        @if ($errors->has('text2_top_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text2_top_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text2_top_en">Text 2 Top English</label>
                        <input type="text" class="form-control{{ $errors->has('text2_top_en') ? ' is-invalid' : '' }}" name="text2_top_en" id="text2_top_en" placeholder="Text 2 Top English" value="{{ old('text2_top_en') }}" required>
                        @if ($errors->has('text2_top_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text2_top_en') }}</strong>
                            </span>
                        @endif
                    </div>  

                    <div class="form-group">
                        <label for="text2_down_in">Text 2 Down Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text2_down_in') ? ' is-invalid' : '' }}" name="text2_down_in" id="text2_down_in" placeholder="Text 2 Down Indonesia" value="{{ old('text2_down_in') }}" required>
                        @if ($errors->has('text2_down_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text2_down_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text2_down_en">Text 2 Down English</label>
                        <input type="text" class="form-control{{ $errors->has('text2_down_en') ? ' is-invalid' : '' }}" name="text2_down_en" id="text2_down_en" placeholder="Text 2 Down English" value="{{ old('text2_down_en') }}" required>
                        @if ($errors->has('text2_down_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text2_down_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text3_in">Text 3 Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text3_in') ? ' is-invalid' : '' }}" name="text3_in" id="text3_in" placeholder="Text 3 Indonesia" value="{{ old('text3_in') }}" required>
                        @if ($errors->has('text3_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text3_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text3_en">Text 3 English</label>
                        <input type="text" class="form-control{{ $errors->has('text3_en') ? ' is-invalid' : '' }}" name="text3_en" id="text3_en" placeholder="Text 3 English" value="{{ old('text3_en') }}" required>
                        @if ($errors->has('text3_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text3_en') }}</strong>
                            </span>
                        @endif
                    </div> 

                    <div class="form-group">
                        <label for="text_url_in">Text URL Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('text_url_in') ? ' is-invalid' : '' }}" name="text_url_in" id="text_url_in" placeholder="Text URL Indonesia" value="{{ old('text_url_in') }}" required>
                        @if ($errors->has('text_url_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_url_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="text_url_en">Text URL English</label>
                        <input type="text" class="form-control{{ $errors->has('text_url_en') ? ' is-invalid' : '' }}" name="text_url_en" id="text_url_en" placeholder="Text URL English" value="{{ old('text_url_en') }}" required>
                        @if ($errors->has('text_url_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('text_url_en') }}</strong>
                            </span>
                        @endif
                    </div>  

                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="URL " value="{{ old('url') }}" required>
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="rowstate">Status</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate" id="rowstate" style="width: 100%;" required>
                            <option value="">--Pilih Status--</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
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
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('article') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection