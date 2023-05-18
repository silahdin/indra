@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    //Number Only
    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('input.number').keyup(function(event) {

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                ;
            });
    });

    $('#merk').change(function(){
        var Pdata = {
            "merk": $("#merk").val()
          };

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            url: "{{ route('post.posttype') }}",
            data: Pdata,
            cache: false,
            type: "POST",
            beforeSend: function() {
                $('#preloader').show();
            },
            success: function(msg){
                $('#preloader').hide();
                $("#DivModel").html(msg);
            },
            error: function(datapost){

            }
        });

      });
});
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('tdescription');

    $(".btn-success").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
        $(this).parents(".control-group").remove();
    });
});
</script>
<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    #loader {
        display: block;
        position: relative;
        left: 50%;
        top: 50%;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #9370DB;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }
    #loader:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #BA55D3;
        -webkit-animation: spin 3s linear infinite;
        animation: spin 3s linear infinite;
    }
    #loader:after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #FF00FF;
        -webkit-animation: spin 1.5s linear infinite;
        animation: spin 1.5s linear infinite;
    }
    @-webkit-keyframes spin {
        0%   {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes spin {
        0%   {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tambah Mobil</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Mobil</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('mobil.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">
                    @if(Auth::user()->level == "Administrator")
                        <?php
                        $dealers = DB::table('dealers')
                        ->orderBy('name', 'ASC')
                        ->get();
                        ?>
                        <div class="form-group">
                        <label for="dealer_id">Dealer</label>
                            <select class="form-control{{ $errors->has('dealer_id') ? ' is-invalid' : '' }} select2" name="dealer_id" id="dealer_id" style="width: 100%;" required>
                                <option value="">---Pilih Dealer</option>
                                @foreach($dealers as $del)
                                    <option value="{{ $del->id }}" >{{ $del->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('dealer_id'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('dealer_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    @else
                    <input type="hidden" value="{{ Auth::user()->id }}" >
                    @endif

                    <div class="form-group">
                        <label for="sub_kategori">Title</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Title" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="merk">Merk Mobil</label>
                        <select class="form-control{{ $errors->has('merk') ? ' is-invalid' : '' }} select2" name="merk" id="merk" style="width: 100%;" required>
                            <option value="">---Pilih Merk Mobil</option>
                            @foreach($merks as $merk)
                                <option value="{{ $merk->id }}" >{{ $merk->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('merk'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('merk') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div id="preloader" style="display: none">
                        <div id="loader"></div>
                    </div>

                    <div class="form-group">
                            <label for="type">Type Mobil</label>
                              <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }} select2" name="type" id="DivModel" style="width: 100%;" required>
                                  <option value="">---Pilih Merk Mobil</option>
                              </select>

                              @if ($errors->has('type'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('type') }}</strong>
                                  </span>
                              @endif
                          </div>

                    <div class="form-group">
                      <label for="tahun">Tahun</label>
                      <input type="text" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }} numbersOnly" name="tahun" id="tahun" placeholder="Tahun" value="{{ old('tahun') }}" required>
                      @if ($errors->has('tahun'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('tahun') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="warna">Warna</label>
                      <input type="text" class="form-control{{ $errors->has('warna') ? ' is-invalid' : '' }}" name="warna" id="warna" placeholder="Warna" value="{{ old('warna') }}" required>
                      @if ($errors->has('warna'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('warna') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="transmisi">Transmisi</label>
                      <select class="form-control{{ $errors->has('transmisi') ? ' is-invalid' : '' }} select2" name="transmisi" id="transmisi" style="width: 100%;" required>
                          <option value="">---Pilih Transmisi</option>
                          <option value="Automatic">Automatic</option>
                          <option value="Manual">Manual</option>
                      </select>
                      @if ($errors->has('transmisi'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('transmisi') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="kilometer">Kilometer</label>
                      <input type="text" class="form-control{{ $errors->has('kilometer') ? ' is-invalid' : '' }} numbersOnly" name="kilometer" id="kilometer" placeholder="Kilometer" value="{{ old('kilometer') }}" required>
                      @if ($errors->has('kilometer'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('kilometer') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="pajak">Masa berlaku pajak (STNK)</label>
                      <input type="text" class="form-control{{ $errors->has('pajak') ? ' is-invalid' : '' }} numbersOnly" name="pajak" id="pajak" placeholder="Masa berlaku pajak (STNK)" value="{{ old('pajak') }}" required>
                      @if ($errors->has('pajak'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pajak') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }} number" name="price" id="price" placeholder="Harga" value="{{ old('price') }}" required>
                    @if ($errors->has('price'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="tdescription">Description</label>
                    <textarea class="form-control{{ $errors->has('tdescription') ? ' is-invalid' : '' }}" name="tdescription" id="tdescription" required>{{ old('tdescription') }}</textarea>
                    @if ($errors->has('tdescription'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('tdescription') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="bpkb">BPKB di Gratama Finance?</label>
                        <input type="radio" name="bpkb" value="1" required> Yes &nbsp;
                        <input type="radio" name="bpkb" value="0" required> No

                        @if ($errors->has('bpkb'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('bpkb') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="box-header with-border" style="background-color: #3c8dbc; color: #FFF">
                      <h3 class="box-title"><strong>Foto Mobil</strong></h3>
                      <br>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="depan">Foto Depan</label>
                            <input type="file" class="form-control{{ $errors->has('depan') ? ' is-invalid' : '' }}" name="depan" id="depan" required>
                            @if ($errors->has('depan'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('depan') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="belakang">Foto Belakang</label>
                            <input type="file" class="form-control{{ $errors->has('belakang') ? ' is-invalid' : '' }}" name="belakang" id="belakang" required>
                            @if ($errors->has('belakang'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('belakang') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="kanan">Foto Kanan</label>
                            <input type="file" class="form-control{{ $errors->has('kanan') ? ' is-invalid' : '' }}" name="kanan" id="kanan" required>
                            @if ($errors->has('kanan'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('kanan') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="kiri">Foto Kiri</label>
                            <input type="file" class="form-control{{ $errors->has('kiri') ? ' is-invalid' : '' }}" name="kiri" id="kiri" required>
                            @if ($errors->has('kiri'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('kiri') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="interdepan">Foto Interior Depan</label>
                            <input type="file" class="form-control{{ $errors->has('interdepan') ? ' is-invalid' : '' }}" name="interdepan" id="interdepan" required>
                            @if ($errors->has('interdepan'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('interdepan') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="interbelakang">Foto Interior Belakang</label>
                            <input type="file" class="form-control{{ $errors->has('interbelakang') ? ' is-invalid' : '' }}" name="interbelakang" id="interbelakang" required>
                            @if ($errors->has('interbelakang'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('interbelakang') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="mesin">Foto Mesin</label>
                            <input type="file" class="form-control{{ $errors->has('mesin') ? ' is-invalid' : '' }}" name="mesin" id="mesin" required>
                            @if ($errors->has('mesin'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('mesin') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="kilometer">Foto Kilometer</label>
                            <input type="file" class="form-control{{ $errors->has('kilometer') ? ' is-invalid' : '' }}" name="gkilometer" id="gkilometer" required>
                            @if ($errors->has('kilometer'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('kilometer') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                    </div>



                    <div class="box-header with-border" style="background-color: #3c8dbc; color: #FFF">
                      <h3 class="box-title"><strong>Aksesoris</strong></h3>
                      <br>
                    </div>
                    <br>

                    <div class="input-group control-group increment" >

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="name_field">Nama Field</label>
                              <input type="text" class="form-control{{ $errors->has('name_field') ? ' is-invalid' : '' }}" name="name_field[]" id="name_field" placeholder="Nama Field" value="" required>
                              @if ($errors->has('name_field'))
                                    <span class="invalid-feedback" style="color: red">
                                        <strong>{{ $errors->first('name_field') }}</strong>
                                    </span>
                                @endif
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="description">Keterangan Field</label>
                            <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description[]" id="description" placeholder="Keterangan Field" value="" required style="margin-right: 250px">
                            @if ($errors->has('description'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>

                        <div class="col-md-1" style="margin-top: 25px; margin-left: -32px">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>

                      </div>
                    </div>




                          <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">

                              <div class="row">

                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="name_field">Nama Field</label>
                                      <input type="text" class="form-control{{ $errors->has('name_field') ? ' is-invalid' : '' }}" name="name_field[]" id="name_field" placeholder="Nama Field" value="">
                                      @if ($errors->has('name_field'))
                                            <span class="invalid-feedback" style="color: red">
                                                <strong>{{ $errors->first('name_field') }}</strong>
                                            </span>
                                        @endif
                                  </div>
                                </div>

                                <div class="col-sm-5" style="margin-right: 26px;">
                                  <div class="form-group">
                                    <label for="description">Keterangan Field</label>
                                    <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description[]" id="description" placeholder="Keterangan Field" value="" style="margin-right: 195px">
                                    @if ($errors->has('description'))
                                          <span class="invalid-feedback" style="color: red">
                                              <strong>{{ $errors->first('description') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                                </div>

                                <div class="col-sm-1" style="margin-top: 25px; margin-left: -30px;">
                                  <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                  </div>
                                </div>

                              </div>
                            </div>
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
