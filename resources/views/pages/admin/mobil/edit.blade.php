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

        CKEDITOR.replace('description');
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
                <li class="active">Edit Mobil - {{ $mobil->name }}</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Mobil - {{ $mobil->name }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('mobil.update', ['id' => Crypt::encryptString($mobil->id)]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" id="image_old" name="image_old" value="{{ $mobil->image }}">
                  <div class="box-body">

                    <div class="form-group">
                        <label for="sub_kategori">@lang('main.title')</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Title" value="{{ $mobil->name }}" required>
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
                                <option value="{{ $merk->id }}" @if($merk->id==$mobil->merk) selected="selected" @endif>{{ $merk->name }}</option>
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
                            <label for="type">@lang('main.type_mobil')</label>
                              <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }} select2" name="type" id="DivModel" style="width: 100%;" required>
                                  <option value="">---Pilih Merk Mobil</option>
                                  @foreach($types as $type)
                                      <option value="{{ $type->id }}" @if($type->id==$mobil->type) selected="selected" @endif>{{ $type->name }}</option>
                                  @endforeach
                              </select>

                              @if ($errors->has('type'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('type') }}</strong>
                                  </span>
                              @endif
                          </div>
                    <div class="form-group">
                      <label for="tahun">@lang('main.tahun')</label>
                      <input type="text" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }} numbersOnly" name="tahun" id="tahun" placeholder="Tahun" value="{{ $mobil->tahun }}" required>
                      @if ($errors->has('tahun'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('tahun') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="warna">@lang('main.warna')</label>
                      <input type="text" class="form-control{{ $errors->has('warna') ? ' is-invalid' : '' }}" name="warna" id="warna" placeholder="Warna" value="{{ $mobil->warna }}" required>
                      @if ($errors->has('warna'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('warna') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="transmisi">@lang('main.transfer')</label>
                      <select class="form-control{{ $errors->has('transmisi') ? ' is-invalid' : '' }} select2" name="transmisi" id="transmisi" style="width: 100%;" required>
                          <option value="">---@lang('main.choose_transfer')</option>
                          <option value="Automatic" @if($mobil->transmisi=="Automatic") selected="selected" @endif>@lang('main.automatic')</option>
                          <option value="Manual" @if($mobil->transmisi=="Manual") selected="selected" @endif>@lang('main.manual')</option>
                      </select>
                      @if ($errors->has('transmisi'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('transmisi') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="kilometer">@lang('main.kilometer')</label>
                      <input type="text" class="form-control{{ $errors->has('kilometer') ? ' is-invalid' : '' }} numbersOnly" name="kilometer" id="kilometer" placeholder="Kilometer" value="{{ $mobil->kilometer }}" required>
                      @if ($errors->has('kilometer'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('kilometer') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="pajak">Masa berlaku pajak (STNK)</label>
                      <input type="text" class="form-control{{ $errors->has('pajak') ? ' is-invalid' : '' }} numbersOnly" name="pajak" id="pajak" placeholder="Masa berlaku pajak (STNK)" value="{{ $mobil->pajak }}" required>
                      @if ($errors->has('pajak'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pajak') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="price">@lang('main.harga')</label>
                    <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }} number" name="price" id="price" placeholder="Harga" value="{{ $mobil->price }}" required>
                    @if ($errors->has('price'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <img src="../../../{{ $mobil->image }}" height="300px">
                    </div>

                    <div class="form-group">
                        <label for="price">@lang('gambar_image')</label>
                        <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="image">
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="description">@lang('main.description')</label>
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required>{{ $mobil->description }}</textarea>
                    @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="bpkb">BPKB di Gratama Finance?</label>
                        <input type="radio" name="bpkb" value="1" required  @if($mobil->bpkb==1) checked @endif > Yes &nbsp;
                        <input type="radio" name="bpkb" value="0" required  @if($mobil->bpkb==0) checked @endif > No

                        @if ($errors->has('bpkb'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('bpkb') }}</strong>
                            </span>
                        @endif
                    </div>

                    @if(Auth::user()->level == "Administrator")
                    <div class="form-group">
                        <label for="st_car">@lang('main.status')</label>
                        <select class="form-control{{ $errors->has('st_car') ? ' is-invalid' : '' }}" name="st_car" id="st_car" style="width: 100%;" required>
                            <option value="">---@lang('main.choose_mobil_status')</option>
                            <option value="1" @if($mobil->st_car == 1) selected="selected" @endif>@lang('main.activity')</option>
                            <option value="0" @if($mobil->st_car == 0) selected="selected" @endif>@lang('main.non_activity')</option>
                        </select>
                        @if ($errors->has('st_car'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_car') }}</strong>
                            </span>
                        @endif
                    </div>
                    @else
                    <input type="hidden" id="st_car" name="st_car" value="{{ $mobil->st_car }}">
                    @endif

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('mobils') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
