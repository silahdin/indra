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
            <li><a href="{{ route('hal')}}">Menu Header</a></li>
            <li class="active">Add Menu Header</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Data Halaman</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('hal.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="name_in">Nama Menu Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('name_in') ? ' is-invalid' : '' }}" name="name_in" id="name_in" placeholder="Nama Menu Indonesia" value="{{ old('name_in') }}" required>
                        @if ($errors->has('name_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name_en">Nama Menu English</label>
                        <input type="text" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" id="name_en" placeholder="JNama Menu English" value="{{ old('name_en') }}" required>
                        @if ($errors->has('name_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name_en') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="form-group">
                        <label for="title_in">Judul Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('title_in') ? ' is-invalid' : '' }}" name="title_in" id="title_in" placeholder="Judul Indonesia" value="{{ old('title_in') }}" required>
                        @if ($errors->has('title_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="title_en">Judul English</label>
                        <input type="text" class="form-control{{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" id="title_en" placeholder="Judul English" value="{{ old('title_en') }}" required>
                        @if ($errors->has('title_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="url">Url Slug</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="Title Indonesia" value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*Field ini jika dikosongkan akan mengenerate otomatis URL sesuai dengan judul</span>
                    </div>

                    <div class="form-group">
                        <label for="content_in">Konten Indonesia</label>
                        <textarea class="form-control{{ $errors->has('content_in') ? ' is-invalid' : '' }}" name="content_in" id="content_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ old('content_in') }}</textarea>
                        @if ($errors->has('content_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content_en">Konten English</label>
                        <textarea class="form-control{{ $errors->has('content_en') ? ' is-invalid' : '' }}" name="content_en" id="content_en" placeholder="Konten English"  cols="5" rows="2" required>{{ old('content_in') }}</textarea>
                        @if ($errors->has('content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_en') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="position">Posisi Menu</label>
                        <select class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" id="position" style="width: 100%;" required>
                            <option value="">--Pilih Posisi--</option>
                            <?php foreach ($cat as $key) { ?>
                                <option value="{{ $key->position_id }}"> {{ $key->name }} </option>
                            <?php } ?>
                        </select>
                        @if ($errors->has('position'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('position') }}</strong>
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
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('hal') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection