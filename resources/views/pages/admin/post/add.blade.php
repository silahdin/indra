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
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" placeholder="Title" value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images" id="images" required>
                        @if ($errors->has('images'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <textarea class="form-control{{ $errors->has('short_desc') ? ' is-invalid' : '' }}" name="short_desc" id="short_desc" required>{{ old('short_desc') }}</textarea>
                    @if ($errors->has('short_desc'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('short_desc') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('mobils') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection