@extends('layouts.applte')

@section('content')
<!-- DataTables -->
<!-- E:\xampp\htdocs\gratama_office\public\assets\lte\bower_components\bootstrap-datepicker\dist\css -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
})
</script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>
<script>
$(function () {
    // CKEDITOR.replace('description');
    CKEDITOR.replace('details');
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
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('service')}}">Hal. Service</a></li>
            <li class="active">Data Service</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-nama">Add Service</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">


                  <div class="form-group">
                        <label for="img_head">Photo Banner</label>                        
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <small>Disarankan ukuran gambar 1080px X 720px</small>
                            <!-- <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*Field ini bisa dikosongkan</span>                        
                            <div class="image-size-label">
                              Atur ulang ukuran gambar
                            </div>
                            <input type="range" class="cropit-image-zoom-input slider" style="width: 29%"> -->
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                   </div>
    <script>
      $(function() {
        $('.image-editor').cropit({ 
            // width: 310,
            // height: 206.5,
            smallImage: 'allow' ,               
            width: 1350,
            height: 500,            
            'minZoom': 1
        });

        $('form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export');
          $('.hidden-image-data').val(imageData);

          // Print HTTP request params
          var formValue = $(this).serialize();
          $('#result-data').text(formValue);

          // Prevent the form from actually submitting
          return true;
        });
      });
    </script>
                    <div class="form-group">
                        <label for="nama">@lang('main.name_judul')</label>
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" placeholder="Full Name" value="{{ old('nama') }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nama_ch">@lang('main.name_judu1_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama_ch" id="nama_ch" placeholder="Full Name" value="{{ old('nama_ch') }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- NEW : URL SLUG -->
                    <div class="form-group">
                        <label for="slug">URL Slug </label>
                        <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" placeholder="URL Slug" value="{{ old('slug') }}" required pattern="[A-Za-z0-9_-]*">
                        <small>Hanya bisa menggunakan alphabet, angka dan simbol "-" atau "_" </small>
                        @if ($errors->has('slug'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('slug') }}</strong>
                            </span>
                        @endif
                    </div>
                    

                    <div class="form-group">
                        <label for="description">@lang('main.descript')</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" placeholder="description in english"  cols="5" rows="12">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description_ch">@lang('main.descript_ch')</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description_ch" id="description_cj" placeholder="description in chinese"  cols="5" rows="12">{{ old('description_ch') }}</textarea>
                        @if ($errors->has('descript_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="details">@lang('main.button_detail')</label>
                        <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details" placeholder="Summary"  cols="5" rows="12" required>{{ old('details') }}</textarea>
                        @if ($errors->has('details'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                        @endif
                    </div>  
                     <div class="form-group">
                        <label for="details">@lang('main.detail_ch')</label>
                        <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details_ch" id="details_ch" placeholder="Summary"  cols="5" rows="12" required>{{ old('details_ch') }}</textarea>
                        @if ($errors->has('details_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('details_ch') }}</strong>
                            </span>
                        @endif
                    </div>  

                    <div class="form-group">
                        <label for="contact_person">@lang('main.contact')</label>
                        <select name="contact_person" id="contact_person">
                            <option value="">@lang('main.choose_one')</option>
                            @foreach($contacts as $contact)
                            <option value="{{$contact->contact_id}}" <?php if($contact->contact_id === old('contact_person')){echo "selected";}else{}?>>{{$contact->name}} ({{$contact->title}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact_person1">@lang('main.contact')</label>
                        <select name="contact_person1" id="contact_person1">
                            <option value="">@lang('main.choose_one')</option>
                            @foreach($contacts as $contact)
                            <option value="{{$contact->contact_id}}" <?php if($contact->contact_id === old('contact_person1')){echo "selected";}else{}?>>{{$contact->name}} ({{$contact->title}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="img_head">Attachment</label>                        
                            <input name="attachment[]" type="file" multiple="multiple">
                            <small>Nama yang tertera di page sama dengan nama file yang diupload, mohon untuk diperhatikan.</small>
                            
                    </div>

                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.add')</button>
                    <a type="button" class="btn btn-default" href="{{ route('service') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection