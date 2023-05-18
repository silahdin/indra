<?php
        function convert_tgl_to_user($tgl){
            //UBAH TANGGAL BIAR BISA TAMPILANNYA B.INDO
            $tgl_1 = substr($tgl, 0,4);
            $tgl_2 = substr($tgl, 5,2);
            $tgl_3 = substr($tgl, 8,2);
            $tgl = $tgl_3.'-'.$tgl_2.'-'.$tgl_1;
            return $tgl;
        }
?>
@extends('layouts.applte')

@section('content')
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
    
    CKEDITOR.replace('details_ch',{
    extraPlugins: 'embed,autoembed,image2',
    height: 500,
    contentsCss: [
    'http://cdn.ckeditor.com/4.11.2/full-all/contents.css',
    'https://ckeditor.com/docs/vendors/4.11.2/ckeditor/assets/css/widgetstyles.css'
     ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/guide/dev_media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],        
    }); 
    
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
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="{{ route('service')}}">Hal. Service</a></li>
            <li class="active">Data Service</li>
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
                  <h3 class="box-title">@lang('main.edit_serve'): 
                  
                  <?php $lang_org = session('language');
                 if($lang_org=='en')
                 {
                  echo $post->name;
                  }
                 else
                  {
                   echo $post->name_ch;
                   }
                        			    
                  ?>
                </h3>
                </div>

                <form action="{{ route('service.update', ['id' => $post->service_id]) }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="box-body">

                  <div class="form-group">
                        <label for="img_head">@lang('main.photo_banner')</label>
                        <div>
                            <img src="{{ asset($post->image) }}" alt="" width="300">
                            <br>
                            <br>
                        </div>
                        <div class="image-editor">
                            <input type="file" class="cropit-image-input">
                            <small>@lang('main.image_size') 1080px X 720px</small>
                            <!-- <div class="cropit-preview"></div>
                            <span style="color: blue; font-size: 12px">*Kosongkan inputan gambar jika tidak ingin mengubah gambar</span>
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
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" id="nama" placeholder="Nama" value="{{ $post->name }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="nama">@lang('main.name_judu1_ch')</label>
                        <input type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama_ch" id="nama_ch" placeholder="Nama_ch" value="{{ $post->name_ch }}" required>
                        @if ($errors->has('nama'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('nama_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- NEW : URL SLUG -->
                    <div class="form-group">
                        <label for="slug">URL Slug </label>
                        <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" placeholder="URL Slug" value="{{ $post->slug }}" required pattern="[A-Za-z0-9_-]*">
                        <small>Hanya bisa menggunakan alphabet, angka dan simbol "-" atau "_" </small>
                        @if ($errors->has('slug'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('slug') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="description">@lang('main.descript')</label>
                        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" placeholder="description"  cols="5" rows="12">{{ $post->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="description">@lang('main.descript_ch')</label>
                        <textarea class="form-control{{ $errors->has('description_ch') ? ' is-invalid' : '' }}" name="description_ch" id="description_ch" placeholder="description_ch"  cols="5" rows="12">{{ $post->description_ch }}</textarea>
                        @if ($errors->has('description_ch'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('description_ch') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="details">@lang('main.button_detail')</label>
                        <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" id="details" placeholder="Summary"  cols="5" rows="12" required>{{ $post->details }}</textarea>
                        @if ($errors->has('details'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="details">@lang('main.detail_ch')</label>
                        <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details_ch" id="details_ch" placeholder="Summary_ch"  cols="5" rows="12" required>{{ $post->details_ch }}</textarea>
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
                            <option value="{{$contact->contact_id}}" <?php if($contact->contact_id === $post->contact_person){echo "selected";}else{}?>>{{$contact->name}} ({{$contact->title}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact_person1">@lang('main.contact')</label>
                        <select name="contact_person1" id="contact_person1">
                            <option value="">@lang('main.choose_one')</option>
                            @foreach($contacts as $contact)
                            <option value="{{$contact->contact_id}}" <?php if($contact->contact_id === $post->contact_person1){echo "selected";}else{}?>>{{$contact->name}} ({{$contact->title}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="img_head">Upload Attachment</label>                        
                            <input name="attachment[]" type="file" multiple="multiple">
                            <small>Nama yang tertera di page sama dengan nama file yang diupload, mohon untuk diperhatikan.</small>
                            
                    </div>

                    @if(count($attachment) > 0)
                    <div class="form-group">
                      <label style="font-weight: bolder;">Uploaded Attachment : </label>

                      @foreach($attachment as $file)
                      <div id="row_{{ $file->id }}" style="padding: 5px;">
                        <button type="button" class="btn btn-danger btn-sm" style="margin-right: 5px;" onclick="deleteFile('{{ $file->id }}')"><i class="fa fa-remove"></i></button>
                        <a href="{{ $file->file_url ? asset($file->file_url) : 'javascript:void(0);' }}" target="_blank">{{ $file->file_name }}</a>
                      </div>
                      @endforeach
                    </div>
                    @endif

                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.update')</button>
                    <a type="button" class="btn btn-default" href="{{ route('service') }}">@lang('main.cancel')</a>
                  </div>
                </form>
              </div>

        </section>
      </div>
@endsection


@push('admin_scripts')

<script type="text/javascript">

  function deleteFile(id) {
    $.get('{{ route('attachment.delete') }}' + '/' + id, function(data, status){
      // alert("Data: " + data + "\nStatus: " + status);
      // console.log(data);

      if(data.success){
        $('#row_' + id).remove();
      }else{
        console.log('Error : ', data.msg)
      }
    });
  }

</script>

@endpush