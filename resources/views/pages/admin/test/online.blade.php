@extends('layouts.appcompro_test')

@section('content')

<?php
  use App\Models\TestNewUserAnswer as Answer;
  use App\Models\TestMultipleInput as MultipleInput;
  use App\Models\TestUserUpload as FileAttached;

  $columns = [
    2 => 80,
    3 => 70,
    4 => 60,
  ];
?>

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span style="font-weight: bold; text-transform: uppercase; float: left;">
                      REANDA BERNARDI 
                    </span>
                </div>

                <div class="card-body">

                    <table style="width: 50%;" class="table table-striped table-bordered table-detail">
                      <tr>
                        <td width="25%" style="font-weight: bold;">Name</td>
                        <td width="5%">:</td>
                        <td>{{ Auth::user()->name }}</td>
                      </tr>
                      <tr>
                        <td style="font-weight: bold;">Test</td>
                        <td>:</td>
                        <td>{{ @$step->module->name }} - {{ @$step->name }}</td>
                      </tr>
                      <tr>
                        <td style="font-weight: bold;">Times Left</td>
                        <td>:</td>
                        <td id="demo"></td>
                      </tr>

                      @push('scripts')

                          <script>
                            // Set the date we're counting down to
                            var countDownDate = new Date('{{ @$ongoing->target }}').getTime();

                            // Update the count down every 1 second
                            var x = setInterval(function() {

                              // Get today's date and time
                              var now = new Date().getTime();

                              // Find the distance between now and the count down date
                              var distance = countDownDate - now;

                              // Time calculations for days, hours, minutes and seconds
                              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                              var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                              var zero_hours = '';
                              var zero_minutes = '';
                              var zero_seconds = '';

                              if(hours.toString().length == 1) zero_hours = '0';
                              if(minutes.toString().length == 1) zero_minutes = '0';
                              if(seconds.toString().length == 1) zero_seconds = '0';

                              // Display the result in the element with id="demo"
                              document.getElementById("demo").innerHTML = zero_hours + hours + " : "
                              + zero_minutes + minutes + " : " + zero_seconds + seconds;

                              // If the count down is finished, write some text
                              if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "EXPIRED";

                                $.ajax({
                                    type: 'POST',
                                    url: 'test/expired',
                                    dataType: 'json',
                                    data: {
                                      'id' : '{{ @$ongoing->id }}',
                                    },
                                    success: function (results) {
                                      // console.log(results);
                                        window.location = results;
                                    }
                                });
                              }
                            }, 1000);
                          </script> 

                      @endpush
                      
                    </table>

                    @push('styles')
                      <link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>

                      <style type="text/css">
                        .table-detail td, .table-detail th{
                          padding: .5rem !important;
                        }

                        #demo{
                          font-weight: 900;
                          font-family: 'Allerta Stencil';
                          font-size: 18px;
                        }
                      </style>
                    @endpush
                    

                   

                    <div style="padding: 10px; margin-bottom: 30px;">

                        <form id="add_form" action="{{ route('online.test.progress') }}" method="post" enctype="multipart/form-data">
                        
                            {{ csrf_field() }}

                            <input type="hidden" name="career_id" value="{{ Crypt::encrypt(@$career_id) }}">
                            <input type="hidden" name="module_id" value="{{ Crypt::encrypt(@$step->module->id) }}">
                            <input type="hidden" name="step_id" value="{{ Crypt::encrypt(@$step->id) }}">

                            <!-- START RENDERING -->

                            @foreach(@$questions as $data)

                                <div style="float: left; width: {{ (100/(@$data->column ?? 1))  }}%;">

                                    @if(@$data->type == 'Line Text')

                                        {!! @$data->line_text !!}

                                    @elseif(@$data->type == 'Image')

                                        <img src="{{ @$data->image_url }}" width="100%" height="{{ @$data->image_height ?? '100%' }}" onerror="this.onerror=null;this.src='{{ asset('missing.png') }}';">

                                    @elseif(@$data->type == 'Question')

                                        <div style="float: left; padding-right: 10px; padding-bottom: 5px; margin-top: 7px;"> {!! @$data->text !!} </div>

                                        @if(@$data->alignment == 2)
                                            <div style="float: left; width: 100%;"></div>
                                        @endif

                                        <!-- UPLOADS -->

                                        @if(@$data->answer_type == 'Upload Files')

                                          <div>
                                              <input multiple="multiple" type="file" name="{{ @$data->code }}" id="{{ @$data->code }}" class="form-control upload-file" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>
                                          </div>

                                          <div id="{{ @$data->code }}_error" style="color: red; padding-top: 5px;"></div>

                                          <?php
                                            $uploaded = FileAttached::whereCode(@$data->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->get();
                                          ?>

                                          <div id="{{ @$data->code }}_list" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>

                                                @foreach($uploaded as $item)

                                                    <div class="file-list" id="{{ @$item->token }}">
                                                        <i class="fa fa-times delete-file" style="float: right; cursor: pointer; margin-right: 5px; margin-top: 5px; color: #D63939;" onclick="deleteFileAjax('{{ @$item->token }}')"></i>

                                                        <a href="{{ @$item->url }}" target="_blank">{{ @$item->filename }}</a>
                                                    </div>

                                                @endforeach

                                          </div>

                                        @endif

                                        <!-- PLAIN -->

                                        @if(@$data->answer_type == 'Plain')

                                            <?php
                                              $answer = Answer::whereCode(@$data->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();
                                            ?>

                                            @if(@$data->plain_type == 1)

                                                <input type="text" name="{{ @$data->code }}" id="{{ @$data->code }}" value="{{ @$answer->answer }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>

                                            @elseif(@$data->plain_type == 2)

                                                <textarea name="{{ @$data->code }}" id="{{ @$data->code }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" rows="5" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>{!! @$answer->answer !!}</textarea>

                                            @elseif(@$data->plain_type == 3)

                                                <select class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" name="{{ @$data->code }}" id="{{ @$data->code }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>

                                                    <option value="">-- Choose Answer --</option>
                                                    
                                                    @foreach(explode(',', @$data->question_option ?? '') as $option)

                                                        <option value="{!! trim($option) !!}" {{ (trim($option) == @$answer->answer) ? 'selected' : '' }}>{!! trim($option) !!}</option>

                                                    @endforeach

                                                </select>

                                            @endif

                                        @endif

                                        <!-- CHOICES -->

                                        @if(@$data->answer_type == 'Choices')

                                            <?php
                                              $answer = Answer::whereCode(@$data->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();
                                            ?>

                                            <?php $al = (@$data->answer_alignment == 2) ? 100 : (100/(@$data->answer_max_column ?? 1)); ?>

                                            @foreach(@$data->choices as $choice)

                                                <div style="float: left; width: {{ $al }}%; padding-top: 7px;">
                                                
                                                    <input type="radio" id="{{ @$data->code }}" name="{{ @$data->code }}" value="{{ @$choice->key }}" {{ (@$choice->key == @$answer->answer) ? 'checked' : '' }}> &nbsp; {!! @$choice->key !!} {{ (!isset($choice->text) || $choice->text == '' || $choice->text == null) ? '' : '.' }} {!! @$choice->text !!}

                                                </div>

                                            @endforeach

                                            @if(@$data->use_explanation == 1)

                                                <input type="text" name="{{ @$data->code }}_exp" id="{{ @$data->code }}_exp" class="form-control question" placeholder="Explanation" value="{{ @$answer->explanation }}">

                                            @endif

                                        @endif

                                        <!-- MULTIPLE INPUTS -->

                                        @if(@$data->answer_type == 'Multiple Input')

                                            <?php
                                              $answer = Answer::whereCode(@$data->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();

                                              // print_r(json_decode(@$answer->answer)[0]);
                                            ?>

                                            <input type="hidden" name="{{ @$data->code }}" value="1">

                                            <table border="1px" width="100%">
                                                <tr>
                                                  <td align="center">Action</td>

                                                  @foreach(@$data->multiple_inputs as $multi)
                                                    <td align="center">{{ $multi->key }}</td>
                                                  @endforeach

                                                </tr>


                                                @if(count(@json_decode(@$answer->answer ?? '') ?? []) > 0)

                                                  @foreach(@json_decode(@$answer->answer ?? '') ?? [] as $keyMultiAnswer => $valueMultiAnswer)

                                                    <tr class="tr_clone_{{ @$data->code }} {{ ($keyMultiAnswer > 0) ? 'newClass'.@$data->code : '' }}" valign="top">

                                                      @if($keyMultiAnswer == 0)
                                                        <td style="text-align: center;">
                                                            <a href="javascript:void(0);" class="tr_clone_add_{{ @$data->code }}" title="Add field"><span><i class="fa fa-plus tambah_{{ @$data->code }}"></i></span></a> 
                                                            <a href="javascript:void(0);" class="tr_clone_remove_{{ @$data->code }}" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash-o hapus_{{ @$data->code }}"></i></span></a>
                                                        </td>

                                                        <!-- PUSH TR CLONE -->
                                                        @push('scripts')

                                                          <script>
                                                              $(document).ready(function(){
                                                                  //Cloning
                                                                $(".tr_clone_add_{{ @$data->code }}").click('click', function() {
                                                                    var code = Math.floor(Date.now() / 1000) + '' + Math.floor((Math.random() * 1000) + 1);
                                                                    var $tr    = $(this).closest('.tr_clone_{{ @$data->code }}');
                                                                    var newClass='newClass{{ @$data->code }}';
                                                                    var $clone = $tr.clone().addClass(newClass);
                                                                    $clone.find('input').val('');
                                                                    $clone.find('textarea').val('');
                                                                    $clone.find('textarea').attr('id', 'textarea_{{ @$data->code }}_' + code);
                                                                    $clone.find('div').remove();

                                                                    var newElement = $('.newClass{{ @$data->code }}:last');
                                                                    if(newElement.length == 0){
                                                                      $tr.after($clone);
                                                                    }else{
                                                                      newElement.after($clone);
                                                                    }

                                                                    $(".tambah_{{ @$data->code }}:last").remove(); //Remove field html
                                                                    $(".hapus_{{ @$data->code }}:last").remove(); //Remove field html
                                                                    //$(".inner:last").prepend('<i class="fa fa-plus"></i>');

                                                                    $('.tanggal').datepicker({
                                                                        autoclose: true,
                                                                        format: 'yyyy-mm-dd'
                                                                    });
                                                                });

                                                                $(".tr_clone_remove_{{ @$data->code }}").click('click', function() { //Once remove button is clicked
                                                                    $(".newClass{{ @$data->code }}:last").remove(); //Remove field html
                                                                });

                                                              });
                                                          </script>

                                                        @endpush
                                                      @else
                                                        <td style="text-align: center;">
                                                        </td>
                                                      @endif

                                                      @foreach($valueMultiAnswer as $keyAnswer => $valueAnswer)

                                                        <?php
                                                          $multiModel = MultipleInput::whereCode($keyAnswer)->first();
                                                        ?>

                                                        <td>
                                                          
                                                          @if($multiModel->type == 1)

                                                              <input type="text" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 2)

                                                              <input type="number" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 3)

                                                              <textarea name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" rows="2">{!! @$valueAnswer !!}</textarea>

                                                          @elseif($multiModel->type == 4)

                                                              <input type="text" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control tanggal" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 5)

                                                              <select class="form-control" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" style="width: 100%;">

                                                                  <option value="">-- Choose Answer --</option>
                                                              
                                                                  @foreach(explode(',', @$multiModel->option_list ?? '') as $option)

                                                                      <option value={{ $option }} {{ ($option == @$valueAnswer) ? 'selected' : '' }}>{{ $option }}</option>

                                                                  @endforeach

                                                              </select>

                                                          @endif

                                                        </td>

                                                      @endforeach

                                                    </tr>

                                                  @endforeach

                                                @else
                                                  <tr class="tr_clone_{{ @$data->code }}" valign="top">

                                                    <td style="text-align: center;">
                                                        <a href="javascript:void(0);" class="tr_clone_add_{{ @$data->code }}" title="Add field"><span><i class="fa fa-plus tambah_{{ @$data->code }}"></i></span></a> 
                                                        <a href="javascript:void(0);" class="tr_clone_remove_{{ @$data->code }}" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash-o hapus_{{ @$data->code }}"></i></span></a>
                                                    </td>

                                                    <!-- PUSH TR CLONE -->
                                                    @push('scripts')

                                                      <script>
                                                          $(document).ready(function(){
                                                              //Cloning
                                                            $(".tr_clone_add_{{ @$data->code }}").click('click', function() {
                                                                var code = Math.floor(Date.now() / 1000) + '' + Math.floor((Math.random() * 1000) + 1);
                                                                var $tr    = $(this).closest('.tr_clone_{{ @$data->code }}');
                                                                var newClass='newClass{{ @$data->code }}';
                                                                var $clone = $tr.clone().addClass(newClass);
                                                                $clone.find('input').val('');
                                                                $clone.find('textarea').val('');
                                                                $clone.find('textarea').attr('id', 'textarea_{{ @$data->code }}_' + code);
                                                                $clone.find('div').remove();

                                                                var newElement = $('.newClass{{ @$data->code }}:last');
                                                                if(newElement.length == 0){
                                                                  $tr.after($clone);
                                                                }else{
                                                                  newElement.after($clone);
                                                                }

                                                                $(".tambah_{{ @$data->code }}:last").remove(); //Remove field html
                                                                $(".hapus_{{ @$data->code }}:last").remove(); //Remove field html
                                                                //$(".inner:last").prepend('<i class="fa fa-plus"></i>');

                                                                $('.tanggal').datepicker({
                                                                    autoclose: true,
                                                                    format: 'yyyy-mm-dd'
                                                                });
                                                            });

                                                            $(".tr_clone_remove_{{ @$data->code }}").click('click', function() { //Once remove button is clicked
                                                                $(".newClass{{ @$data->code }}:last").remove(); //Remove field html
                                                            });

                                                          });
                                                      </script>

                                                    @endpush

                                                    @foreach(@$data->multiple_inputs as $multi)

                                                      <td>
                                                      
                                                      @if($multi->type == 1)

                                                          <input type="text" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control">

                                                      @elseif($multi->type == 2)

                                                          <input type="number" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control">

                                                      @elseif($multi->type == 3)

                                                          <textarea name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control" rows="2"></textarea>

                                                      @elseif($multi->type == 4)

                                                          <input type="text" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control tanggal">

                                                      @elseif($multi->type == 5)

                                                          <select class="form-control" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" style="width: 100%;">

                                                              <option value="">-- Choose Answer --</option>
                                                          
                                                              @foreach(explode(',', @$multi->option_list ?? '') as $option)

                                                                  <option value={{ $option }}>{{ $option }}</option>

                                                              @endforeach

                                                          </select>

                                                      @endif

                                                      </td>

                                                    @endforeach

                                                  </tr>

                                                @endif
                                                
                                            </table>

                                        @endif

                                        <!-- GROUP -->

                                        @if(@$data->answer_type == 'Group')

                                            @push('scripts')

                                            <script>
                                                $(".input-group-{{ @$data->code }}").click('click', function() {

                                                    if('{{ @$data->only_one_choice }}' == '1'){

                                                        var dataAttr = ('{{ @$data->transpose_group }}' == '2') ? 'column' : 'row';

                                                        if ($('input[data-'+dataAttr+'-code="'+$(this).data(dataAttr+"-code")+'"]:checked').length > 1) {
                                                            swal('Warning', 'You cannot choose same '+dataAttr+' answer', 'warning');
                                                            $('input[data-'+dataAttr+'-code="'+$(this).data(dataAttr+"-code")+'"]').prop('checked', false);

                                                            // if('{{ @$data->transpose_group }}' == '1'){
                                                            //   $('#'+$(this).data('row-code')).removeAttr('value');
                                                            // }
                                                        }else{
                                                          // if('{{ @$data->transpose_group }}' == '1'){
                                                          //   $('#'+$(this).data('row-code')).val($(this).val());
                                                          // }
                                                        }

                                                    }

                                                    

                                                });
                                            </script>

                                            @endpush

                                            <table class="group-table" border="1px" width="100%">

                                                <tr>
                                                    <td style="width:{{ @$columns[count(@$data->group_answer_rows[0]->group_answer_columns)] ?? 50 }}% !important;"></td>
                                                    @foreach(@$data->group_answer_rows[0]->group_answer_columns as $column)
                                                        <td style="font-weight: bold; text-align: {{ (@$data->group_answer_type == 1) ? 'left' : 'center' }}">
                                                          {{ $column->text }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                
                                                @foreach(@$data->group_answer_rows as $row)

                                                    <tr>

                                                        @if(@$data->transpose_group == 1 && @$data->only_one_choice == 1)
                                                          {{-- <input type="hidden" id="{{ @$row->group_code }}" name="{{ @$row->group_code }}"> --}}
                                                        @endif

                                                        <td>{{ $row->text }}</td>

                                                        @foreach(@$row->group_answer_columns as $column)

                                                            <td style="text-align: center;">
                                                                @if(@$data->group_answer_type == '1')

                                                                    @if($column->disabled != 1)

                                                                        <?php
                                                                          $answer = Answer::whereCode(@$column->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();
                                                                        ?>

                                                                        <input type="text" name="{{ @$column->code }}" id="{{ @$column->code }}" class="form-control" value="{{ @$answer->answer }}">

                                                                    @endif

                                                                @else

                                                                    <?php
                                                                      $checked = false;
                                                                      
                                                                      if(@$data->transpose_group == 2){

                                                                        $answer = Answer::whereCode(@$row->group_code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();

                                                                        if(@$answer->answer == @$column->text) $checked = true;

                                                                      }else{

                                                                        $answer = Answer::whereCode(@$column->group_code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->first();

                                                                        if(@$answer->answer == @$row->text) $checked = true;

                                                                      }
                                                                    ?>
                                                                    <input type="radio" id="{{ @$column->code }}" name="{{ (@$data->transpose_group == 2) ? @$row->group_code : @$column->group_code }}" value="{{ (@$data->transpose_group == 1) ? @$row->text : @$column->text }}" data-row-code="{{ @$row->group_code }}" data-column-code="{{ @$column->group_code }}" class="input-group-{{ @$data->code }}" {{ ($checked) ? 'checked' : '' }}>

                                                                @endif
                                                            </td>

                                                        @endforeach

                                                    </tr>

                                                @endforeach
                                                
                                            </table>

                                        @endif

                                        <div style="float: left; width: 100%;"></div>

                                    @endif



                                </div>

                                <div style="float: left; width: 100%; padding-bottom: 20px;"></div>

                            @endforeach

                            <div style="float: left;padding-top: 20px; padding-bottom: 40px; width: 100%;"></div>

                            <?php
                                $first_step = \App\Models\TestStep::whereModuleId(@$step->module->id)->orderBy('order')->first();
                                $last_step = \App\Models\TestStep::whereModuleId(@$step->module->id)->orderBy('order', 'DESC')->first();
                            ?>

                            <div class="box-footer" style="position: absolute; bottom: 20px; right: 30px;">
                                @if(@$first_step->id == @$last_step->id)

                                  <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-success" name="navigation" value="last">Finish & Submit</button>

                                @else

                                  @if(@$step->id != @$last_step->id)

                                      <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-primary" name="navigation" value="next">Next</button>

                                  @endif

                                  @if(@$step->id != @$first_step->id)

                                      <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-warning" name="navigation" value="prev">Back</button>

                                  @endif

                                  @if(@$step->id == @$last_step->id)

                                      <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-success" name="navigation" value="last">Finish & Submit</button>

                                  @endif

                                @endif

                                

                                
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')

<style type="text/css">

.question{
    width: auto !important;
    float: left !important;
}

.group-table td, .group-table th {
    padding: .75rem;
    vertical-align: top;
}

input[type="radio"]{
  cursor: pointer;
}

.file-list{
    margin-top: 5px;
    border: 1px solid #f7f7f7;
    border-radius: 5px;
    padding: 10px 15px 10px 15px;
    background: #f7f7f7;
}

.delete-file:hover{
    color: red !important;
}

.resend-file:hover{
    color: #16c5e0 !important;
}

.disabled {
    pointer-events: none;
    opacity: 0.4;
}


</style>

@endpush

@push('scripts')

<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Date picker
    $('.tanggal').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $(window).keydown(function(event){
        if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });

    // UPLOAD FILES
    $('.upload-file').change(function(e){
        // console.log('UPLOADING ...', e.target.id)

        var fileInput = document.getElementById(e.target.id);
        var fileInputEl = $('#'+e.target.id);
        var fileInputError = $('#'+e.target.id+'_error');
        var fileInputList = $('#'+e.target.id+'_list');

        fileInputError.html('')

        var allowedExtension = '{{ env('UPLOAD_EXTENSION') }}';
        var maxSize = '{{ env('UPLOAD_MAXSIZE') }}'; // In MB

        if(allowedExtension == '') allowedExtension = 'jpg,jpeg,pdf,png';
        allowedExtension = allowedExtension.split(',');

        if(maxSize == '') maxSize = 20;

        // console.log('EXTENSION ALLOWED : ', allowedExtension)

        // console.log('FILE : ', fileInput.files)

        // var checkExt = 0;
        // var checkSize = 0;

        $.each(fileInput.files, function (index, value) {

            var token = new Date().valueOf() + '_' + e.target.id;

            let ext = value.name.substr(value.name.lastIndexOf('.') + 1)
            let sizeInMB = value.size / 1000000;

            // console.log('FILE NAME : ', value.name)
            // console.log('FILE EXTENSION : ', ext)
            // console.log('FILE SIZE : ', sizeInMB)

            // console.log('EXTENSION PASS : ', allowedExtension.indexOf(ext) > -1)

            // if(allowedExtension.indexOf(ext) <= -1) checkExt += 1;
            // if(sizeInMB > maxSize) checkSize += 1;

            if(allowedExtension.indexOf(ext) <= -1){
                fileInputError.html('Files must be in format : ' + allowedExtension.join(', '))
                return
            }

            if(sizeInMB > maxSize){
                fileInputError.html('Max size for each file is ' + maxSize + ' MB')
                return
            }

            // DO UPLOAD
            let formData = new FormData()

            // fileInputList.append('<div class="file-list">'+value.name+'</div>')

            formData.append('file', value)
            formData.append('token', token)
            formData.append('code', e.target.id)
            formData.append('career_id', '{{ @$career_id }}')
            
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ route('online.upload') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log('Success Upload : ', data)

                    fileInputList.append('<div class="file-list" id="'+token+'">' +
                                            '<i class="fa fa-times delete-file" style="float: right; cursor: pointer; margin-right: 5px; margin-top: 3px; color: #D63939;" onclick="deleteFileAjax(\''+token+'\')"></i>' +

                                                '<a href="'+data.url+'" target="_blank">'+
                                                    data.filename + 
                                                '</a>' +

                                        '</div>');
                },
                error: function(response) {

                    failedFiles.push({
                        'token': token,
                        'file': value,
                        'code': e.target.id,
                        'career_id': '{{ @$career_id }}',
                    })

                    console.log('Error Upload : ', response);

                    // console.log('Failed Upload Files : ', failedFiles);

                    fileInputList.append('<div class="file-list" id="'+token+'">' +
                                            '<i class="fa fa-times delete-file" style="float: right; cursor: pointer; margin-right: 5px; margin-top: 3px; color: #D63939;" onclick="deleteFile(\''+token+'\')"></i>' +

                                            '<i id="'+token+'_resend_icon" class="fa fa-refresh resend-file" style="float: right; cursor: pointer; margin-right: 7px; margin-top: 3px; color: #17a2b8;" onclick="resendFile(\''+token+'\')"></i>' +

                                                value.name +

                                            '<span style="font-size: 13px; color: #D63939;"><br><i class="fa fa-exclamation-circle" style="font-size: 12px;"></i> Failed to upload</span>' +
                                        '</div>');

                }
            }).always(function() {
              fileInputEl.val('');
            });

        });

        // if(checkExt > 0){
        //     fileInputError.html('Files must be in format : ' + allowedExtension.join(', '))
        //     return
        // }

        // if(checkSize > 0){
        //     fileInputError.html('Max size for each file is ' + maxSize + ' MB')
        //     return
        // }


    });
});

function deleteFile(token = ''){
    // console.log('JUST DELETING ...', token)

    swal({
        title: "Are you sure?",
        text: "This file will be deleted, and cannot be recovered!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function (isConfirm) {
        if (isConfirm) {
            var el = document.getElementById(token);
            if(el) el.parentNode.removeChild(el);                      
        }
    });
};

function deleteFileAjax(token = ''){
    // console.log('FILE DELETING ...', token)

    swal({
        title: "Are you sure?",
        text: "This file will be deleted, and cannot be recovered!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            let formData = new FormData()
            formData.append('token', token)

            $.ajax({
                type: "POST",
                url:  '{{ route('online.upload.delete') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log('Success Delete : ', data);
                    
                    var el = document.getElementById(token);
                    if(el) el.parentNode.removeChild(el);

                    swal.close();
                },
                error: function (response) {
                    console.log('Error Delete : ', response);
                }
            });                        
            
        }
    });
};

function resendFile(token = ''){
    // console.log('RESENDING FILE ...', token)

    var listItem = $('#'+token);
    var listItemIcon = $('#'+token+'_resend_icon');

    listItem.addClass('disabled');
    listItemIcon.addClass('fa-spin');

    fileFromFailed = this.failedFiles.filter(data => data.token === token)[0]

    // console.log('GET FILE FROM FAILEDS ...', fileFromFailed)

    // DO UPLOAD
    let formData = new FormData()

    formData.append('file', fileFromFailed.file)
    formData.append('token', fileFromFailed.token)
    formData.append('code', fileFromFailed.code)
    formData.append('career_id', fileFromFailed.career_id)
    
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '{{ route('online.upload') }}',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            // console.log('Success Upload : ', data)

            listItem.html('<i class="fa fa-times delete-file" style="float: right; cursor: pointer; margin-right: 5px; margin-top: 3px; color: #D63939;" onclick="deleteFileAjax(\''+token+'\')"></i>' +
                            '<a href="'+data.url+'" target="_blank">'+
                                data.filename + 
                            '</a>');

            listItem.removeClass('disabled');

            this.failedFiles = this.failedFiles.filter(data => data.token != token)
        },
        error: function(response) {

            console.log('Error Upload : ', response);
            // console.log('Failed Upload Files : ', failedFiles);

            listItem.removeClass('disabled');
            listItemIcon.removeClass('fa-spin');

        }
    });
};

</script>

@endpush