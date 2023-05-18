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
    CKEDITOR.replace('description');
    CKEDITOR.replace('situasi');
    CKEDITOR.replace('bantuan');
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
            <li><a href="{{ route('office')}}">Hal. Office</a></li>
            <li class="active">Data Office</li>
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
                  <h3 class="box-title">Add Office</h3>
                </div>

                <form action="{{ route('office.store') }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">


                      
                  @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <div class="form-group">
                        <label for="dir">Lokasi</label>
                        <select name="dir" id="dir" class="form-control{{ $errors->has('dir') ? ' is-invalid' : '' }}" required>
                            <option value="">Pilih salah satu</option>
                            @foreach($dirs as $dir)
                            <option value="{{$dir->directory_id}}" >{{$dir->directory}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="country">Negara</label>
                        <input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="country" id="country" placeholder="Negara" value="" required>
                    </div>


                    <div class="form-group">
                        <label for="website">Web Address</label>
                        <input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" id="website" placeholder="Alamat Website" value="">
                        @if ($errors->has('website'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                        @endif
                    </div>

                  </div>
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-default" href="{{ route('service') }}">Cancel</a>                  
                  </div>
                </form>
              </div>
    
        </section>
      </div>
@endsection