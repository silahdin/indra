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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
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
                  <h3 class="box-title">Edit Berita/Artikel : {{ $post->title_in }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('article.update', ['id' => $post->article_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                    <div class="form-group">
                        <label for="img_head">Gambar pada Judul</label>
                        <input type="file" class="form-control{{ $errors->has('img_head') ? ' is-invalid' : '' }}" name="img_head" id="img_head">
                        @if ($errors->has('img_head'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('img_head') }}</strong>
                            </span>
                        @endif
                        <span style="color: blue; font-size: 12px">*Kosongkan inputan gambar jika tidak ingin mengubah gambar</span>    
                    </div>

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
                        <label for="url">URL Slug</label>
                        <input type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" id="url" placeholder="URL Slug" value="{{ $post->url }}" required>
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="form-group">
                        <label for="short_content_in">Konten Pendek Indonesia</label>
                        <textarea class="form-control{{ $errors->has('short_content_in') ? ' is-invalid' : '' }}" name="short_content_in" id="short_content_in" placeholder="Konten Pendek Indonesia"  cols="5" rows="3" required>{{ $post->short_content_in }}</textarea>
                        @if ($errors->has('short_content_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('short_content_in') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="short_content_en">Konten Pendek English</label>
                        <textarea class="form-control{{ $errors->has('short_content_en') ? ' is-invalid' : '' }}" name="short_content_en" id="short_content_en" placeholder="Konten Pendek English"  cols="5" rows="3" required>{{ $post->short_content_en }}</textarea>
                        @if ($errors->has('short_content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('short_content_en') }}</strong>
                            </span>
                        @endif
                    </div>                    


                    <div class="form-group">
                        <label for="content_in">Konten Indonesia</label>
                        <textarea class="form-control{{ $errors->has('content_in') ? ' is-invalid' : '' }}" name="content_in" id="content_in" placeholder="Konten Indonesia"  cols="5" rows="2" required>{{ $post->content_in }}</textarea>
                        @if ($errors->has('content_in'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_in') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="content_en">Konten English</label>
                        <textarea class="form-control{{ $errors->has('content_en') ? ' is-invalid' : '' }}" name="content_en" id="content_en" placeholder="Konten English"  cols="5" rows="2" required>{{ $post->content_en }}</textarea>
                        @if ($errors->has('content_en'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('content_en') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="categories_id">Kategori</label>
                        <select class="form-control{{ $errors->has('categories_id') ? ' is-invalid' : '' }}" name="categories_id" id="categories_id" style="width: 100%;" required>
                            <option value="">--Pilih Kategori--</option>
                            <?php foreach ($cat as $key) { ?>
                                <option value="{{ $key->id }}" @if($key->id==$post->rowstate) selected @endif> {{ $key->name_in }} </option>
                            <?php } ?>
                        </select>
                        @if ($errors->has('categories_id'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('categories_id') }}</strong>
                            </span>
                        @endif
                    </div>   

                    <div class="form-group">
                        <label for="rowstate">Status</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate" id="rowstate" style="width: 100%;" required>
                            <option value="">--Pilih Status Produk--</option>
                            <option value="1" @if($post->rowstate==1) selected @endif>Aktif</option>
                            <option value="2" @if($post->rowstate==2) selected @endif>Tidak Aktif</option>
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
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('article') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection