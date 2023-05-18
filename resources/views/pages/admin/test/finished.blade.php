@extends('layouts.appcompro_test')

@section('content')

<?php
  use App\Models\TestNewUserAnswer as Answer;
  use App\Models\TestMultipleInput as MultipleInput;
  use App\Models\TestUserUpload as FileAttached;
  use App\Models\TestMultipleChoice as QuestionAnswer;
?>

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span style="font-weight: bold; text-transform: uppercase;">
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
                      
                    </table>

                    <div style="padding: 10px; margin-bottom: 30px;">

                        <form id="add_form" action="{{ route('online.test.finished') }}" method="post" enctype="multipart/form-data">
                        
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

                                          <?php
                                            $uploaded = FileAttached::whereCode(@$data->code)->whereCareerId(@$career_id)->whereUserId(Auth::user()->id)->get();
                                          ?>

                                          <div id="{{ @$data->code }}_list" @if(@$data->answer_width != null) style="float: left; width: {{ @$data->answer_width  }} !important;" @endif>

                                                @foreach($uploaded as $item)

                                                    <div class="file-list" id="{{ @$item->token }}">
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

                                                <input type="text" name="{{ @$data->code }}" id="{{ @$data->code }}" value="{{ @$answer->answer }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif disabled>

                                            @elseif(@$data->plain_type == 2)

                                                <textarea name="{{ @$data->code }}" id="{{ @$data->code }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" rows="5" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif disabled>{!! @$answer->answer !!}</textarea>

                                            @elseif(@$data->plain_type == 3)

                                                <select class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" name="{{ @$data->code }}" id="{{ @$data->code }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif disabled>

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

                                                <input disabled type="text" name="{{ @$data->code }}_exp" id="{{ @$data->code }}_exp" class="form-control question" placeholder="Explanation" value="{{ @$answer->explanation }}">

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

                                                  @foreach(@$data->multiple_inputs as $multi)
                                                    <td align="center">{{ $multi->key }}</td>
                                                  @endforeach

                                                </tr>


                                                @if(count(@json_decode(@$answer->answer ?? '') ?? []) > 0)

                                                  @foreach(@json_decode(@$answer->answer ?? '') ?? [] as $keyMultiAnswer => $valueMultiAnswer)

                                                    <tr class="tr_clone_{{ @$data->code }} {{ ($keyMultiAnswer > 0) ? 'newClass'.@$data->code : '' }}" valign="top">

                                                      @if($keyMultiAnswer == 0)

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
    
                                                      @endif

                                                      @foreach($valueMultiAnswer as $keyAnswer => $valueAnswer)

                                                        <?php
                                                          $multiModel = MultipleInput::whereCode($keyAnswer)->first();
                                                        ?>

                                                        <td>
                                                          
                                                          @if($multiModel->type == 1)

                                                              <input disabled type="text" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 2)

                                                              <input disabled type="number" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 3)

                                                              <textarea disabled name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control" rows="2">{!! @$valueAnswer !!}</textarea>

                                                          @elseif($multiModel->type == 4)

                                                              <input disabled type="text" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" class="form-control tanggal" value="{{ @$valueAnswer }}">

                                                          @elseif($multiModel->type == 5)

                                                              <select disabled class="form-control" name="{{ @$multiModel->code }}[]" id="{{ @$multiModel->code }}" style="width: 100%;">

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

                                                          <input disabled type="text" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control">

                                                      @elseif($multi->type == 2)

                                                          <input disabled type="number" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control">

                                                      @elseif($multi->type == 3)

                                                          <textarea disabled name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control" rows="2"></textarea>

                                                      @elseif($multi->type == 4)

                                                          <input disabled type="text" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" class="form-control tanggal">

                                                      @elseif($multi->type == 5)

                                                          <select disabled class="form-control" name="{{ @$multi->code }}[]" id="{{ @$multi->code }}" style="width: 100%;">

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
                                                    <td></td>
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

                                                                        <input disabled type="text" name="{{ @$column->code }}" id="{{ @$column->code }}" class="form-control" value="{{ @$answer->answer }}">

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

                                  <a style="padding-left: 20px; padding-right: 20px;" class="btn btn-success" href="{{ route('hometest', ['id' => Crypt::encrypt(@$career_id)]) }}">Back to Modules</a>

                                @else

                                  @if(@$step->id != @$last_step->id)

                                      <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-primary" name="navigation" value="next">Next</button>

                                  @endif

                                  @if(@$step->id != @$first_step->id)

                                      <button style="padding-left: 20px; padding-right: 20px;" type="submit" class="btn btn-warning" name="navigation" value="prev">Back</button>

                                  @endif

                                  @if(@$step->id == @$last_step->id)

                                      <a style="padding-left: 20px; padding-right: 20px;" class="btn btn-success" href="{{ route('hometest', ['id' => Crypt::encrypt(@$career_id)]) }}">Back to Modules</a>

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
    //Date picker
    $('.tanggal').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $(':radio:not(:checked)').attr('disabled', true);

    $(window).keydown(function(event){
        if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });
});


</script>

@endpush