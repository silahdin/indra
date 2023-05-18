@extends('layouts.applte')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
    $(function () {
        CKEDITOR.replace('detail_in');
        CKEDITOR.replace('detail_en');
    });
</script>
<script src="{{ asset('assets/lte/bower_components/cropit/jquery.cropit.js') }}"></script>

<style>
    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 250px;
        height: 250px;
      }

      .cropit-preview-image-container {
        cursor: move;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input {
        display: block;
      }

      button[type="submit"] {
        /* margin-top: 10px; */
      }

      #result {
        margin-top: 10px;
        width: 900px;
      }

      #result-data {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        word-wrap: break-word;
      }

    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 15px;
        border-radius: 5px;   
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        border-radius: 50%; 
        background: #a53a3a;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #a53a3a;
        cursor: pointer;
    }      
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            &nbsp;
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class=" fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('classtraining')}}">Kelas Training</a></li>
            <li class="active">Tambah Kelas Training</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Kelas Training</h3>
            </div>

            <form action="{{ route('classtraining.store') }}" method="post" enctype="multipart/form-data" id="input">
                {{ csrf_field() }}
                <div class="box-body">


                <div class="form-group">
                        <label for="id_training">Pilih Training</label>
                        <select class="form-control{{ $errors->has('id_training') ? ' is-invalid' : '' }}" name="id_training" id="categories_id" style="width: 100%;" required>
                            <option value="">--Pilih Training--</option>
                            <?php foreach ($cat as $key) { ?>
                                <option value="{{ $key->id }}"> {{ $key->title_in }} </option>
                            <?php } ?>
                        </select>
                        @if ($errors->has('categories_id'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('categories_id') }}</strong>
                            </span>
                        @endif
                    </div>       

                    <div class="form-group">
                        <label for="class_name_in">Nama Kelas Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('class_name_in') ? ' is-invalid' : '' }}"
                            name="class_name_in" id="class_name_in" placeholder="Nama Kelas Indonesia" value="{{ old('class_name_in') }}"
                            required>
                        @if ($errors->has('class_name_in'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('class_name_in') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="class_name_en">Nama Kelas English</label>
                        <input type="text" class="form-control{{ $errors->has('class_name_en') ? ' is-invalid' : '' }}"
                            name="class_name_en" id="class_name_en" placeholder="Nama Kelas English" value="{{ old('class_name_en') }}"
                            required>
                        @if ($errors->has('class_name_en'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('class_name_en') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="info_in">Info Indonesia</label>
                        <input type="text" class="form-control{{ $errors->has('info_in') ? ' is-invalid' : '' }}" name="info_in"
                            id="info_in" placeholder="Info Indonesia" value="{{ old('info_in') }}" required>
                        @if ($errors->has('info_in'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('info_in') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="info_en">Info English</label>
                        <input type="text" class="form-control{{ $errors->has('info_en') ? ' is-invalid' : '' }}" name="info_en"
                            id="info_en" placeholder="Info English" value="{{ old('info_en') }}" required>
                        @if ($errors->has('info_en'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('info_en') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }} money"
                            name="price" id="price" placeholder="Harga" value="{{ old('price') }}" required>
                        @if ($errors->has('price'))
                        <span class="invalid-feedback" style="color: red">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="rowstate">Status</label>
                        <select class="form-control{{ $errors->has('rowstate') ? ' is-invalid' : '' }}" name="rowstate"
                            id="rowstate" style="width: 100%;" required>
                            <option value="">--Pilih Status Produk--</option>
                            <option value="3">Waiting</option>
                            <option value="4">Resgitered</option>
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
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('classtraining') }}'">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $('.money').maskMoney({ prefix: 'Rp. ', thousands: ',', decimal: '.', precision: 0 });
    $('.number').maskMoney({ suffix: ' jam', prefix: '', thousands: ',', decimal: '.', precision: 0 });
    $('.decimal').maskMoney({ prefix: '', thousands: ',', decimal: '.', allowZero: true });

</script>


@endsection