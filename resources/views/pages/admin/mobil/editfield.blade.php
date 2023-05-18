@extends('layouts.applte')

@section('content')

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
                  <h3 class="box-title">Edit Field Mobil {{ $field->name }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('mobil.updatefield', ['id' => $field->id_field]) }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="mobil_id" value="{{ $field->car_id }}">
                  <div class="box-body">
                    
                    <div class="form-group">
                        <label for="sub_kategori">Nama Field</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama Field" value="{{ $field->name }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    
                    <div class="form-group">
                      <label for="description">Keterangan Field</label>
                      <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" placeholder="Keterangan Field" value="{{ $field->description }}" required>
                      @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('mobils') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection