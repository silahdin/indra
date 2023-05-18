@extends('layouts.appcompro_test')

@section('content')

<?php
  use App\Models\TestMultipleChoice as QuestionAnswer;
?>

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <span>
                        {{ @$data->step->module->name }} - {{ @$data->step->name }}
                    </span>

                    <a href="{{ route('question.index') }}" class="btn btn-primary" style="float: right; margin-right: 10px; padding-left: 20px; padding-right: 20px;">Back to Questions</a>
                </div>

                <div class="card-body">

                    <table style="border: 1px #848484 solid; width: 100%; margin-bottom: 20px;">
                        <tr>
                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%">Question Code</td>
                            <td width="5%">:</td>
                            <td width="30%">{{ @$data->code }}</td>

                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%">Order</td>
                            <td width="5%">:</td>
                            <td width="30%">{{ @$data->order }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%">Type</td>
                            <td width="5%">:</td>
                            <td width="30%">{{ @$data->type }}</td>

                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%">Column</td>
                            <td width="5%">:</td>
                            <td width="30%">{{ @$data->column }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%">Alignment</td>
                            <td width="5%">:</td>
                            <td width="30%">{{ (@$data->alignment == 1) ? 'Horizontal' : 'Vertical' }}</td>

                            <td style="padding: 5px; padding-left: 10px; font-weight: bold;" width="15%"></td>
                            <td width="5%"></td>
                            <td width="30%"></td>
                        </tr>
                    </table>

                    <hr>

                    <div style="padding: 10px; margin-bottom: 30px;">

                        <!-- START RENDERING -->

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

                                        @endif

                                 <!-- PLAIN -->

                                        @if(@$data->answer_type == 'Plain')

                                            @if(@$data->plain_type == 1)

                                                <input type="text" name="{{ @$data->code }}" id="{{ @$data->code }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>

                                            @elseif(@$data->plain_type == 2)

                                                <textarea name="{{ @$data->code }}" id="{{ @$data->code }}" class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" rows="5" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif></textarea>

                                            @elseif(@$data->plain_type == 3)

                                                <select class="form-control {{ (@$data->answer_width == null) ? 'question' : '' }}" name="{{ @$data->code }}" id="{{ @$data->code }}" @if(@$data->answer_width != null) style="width: {{ @$data->answer_width  }} !important;" @endif>
                                                    
                                                    @foreach(explode(',', @$data->question_option ?? '') as $option)

                                                        <option value={{ $option }}>{{ $option }}</option>

                                                    @endforeach

                                                </select>

                                            @endif

                                        @endif

                                <!-- CHOICES -->

                                @if(@$data->answer_type == 'Choices')

                                    <?php $al = (@$data->answer_alignment == 2) ? 100 : (100/(@$data->answer_max_column ?? 1)); ?>

                                    @foreach(@$data->choices as $choice)

                                        <div style="float: left; width: {{ $al }}%; padding-top: 7px;">
                                        
                                            <input type="radio" id="{{ @$data->code }}" name="{{ @$data->code }}" value="{{ @$choice->key }}"> &nbsp; {!! @$choice->key !!} {{ !isset($choice->text) ? '.' : '' }} {!! @$choice->text !!}

                                        </div>

                                    @endforeach

                                    @if(@$data->use_explanation == 1)

                                        <input type="text" name="{{ @$data->code }}_exp" id="{{ @$data->code }}_exp" class="form-control question" placeholder="Explanation">

                                    @endif

                                    <?php
                                        $question_answer = QuestionAnswer::whereQuestionId(@$data->id)->where('key', @$data->right_answer)->first();

                                        $isTableText = strpos(@$question_answer->text, '</table>') !== false;
                                    ?>

                                    @if(@$question_answer)
                                        <div style="float:left; margin-top: 8px !important; font-weight: 600;">Answer: {{ @$data->right_answer }} {!! (@$question_answer && !$isTableText) ? ' - '.@$question_answer->text : '' !!}</div>
                                    @endif

                                @endif

                                <!-- MULTIPLE INPUTS -->

                                @if(@$data->answer_type == 'Multiple Input')

                                    <table border="1px" width="100%">
                                        <tr>
                                          <td align="center">Action</td>

                                          @foreach(@$data->multiple_inputs as $multi)
                                            <td align="center">{{ $multi->key }}</td>
                                          @endforeach

                                        </tr>

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

                                                <select class="form-control" name="{{ @$data->code }}[]" id="{{ @$data->code }}" style="width: 100%;">
                                                
                                                    @foreach(explode(',', @$multi->option_list ?? '') as $option)

                                                        <option value={{ $option }}>{{ $option }}</option>

                                                    @endforeach

                                                </select>

                                            @endif

                                            </td>

                                          @endforeach
                                        </tr>

                                        
                                    </table>

                                @endif

                                <!-- GROUP -->

                                @if(@$data->answer_type == 'Group')

                                    <table class="group-table" border="1px" width="100%">

                                        <tr>
                                            <td></td>
                                            @foreach(@$data->group_answer_rows[0]->group_answer_columns as $column)
                                                <td style="font-weight: bold; text-align: {{ (@$data->group_answer_type == 1) ? 'left' : 'center' }}">{{ $column->text }}</td>
                                            @endforeach
                                        </tr>
                                        
                                        @foreach(@$data->group_answer_rows as $row)

                                            <tr>

                                                <td>{{ $row->text }}</td>

                                                @foreach(@$row->group_answer_columns as $column)

                                                    <td style="text-align: center;">
                                                        @if(@$data->group_answer_type == '1')

                                                            @if($column->disabled != 1)

                                                                <input type="text" name="{{ @$column->code }}" id="{{ @$column->code }}" class="form-control">

                                                            @endif

                                                        @else

                                                            <input type="radio" id="{{ @$column->code }}" name="{{ (@$data->transpose_group == 2) ? @$row->group_code : @$column->group_code }}" value="{{ @$column->text }}" data-row-code="{{ @$row->group_code }}" data-column-code="{{ @$column->group_code }}" class="input-group">

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

    $(window).keydown(function(event){
        if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });

    // UPLOAD FILES
    $('.upload-file').change(function(e){

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

        $.each(fileInput.files, function (index, value) {

            var token = new Date().valueOf() + '_' + e.target.id;

            let ext = value.name.substr(value.name.lastIndexOf('.') + 1)
            let sizeInMB = value.size / 1000000;


            if(allowedExtension.indexOf(ext) <= -1){
                fileInputError.html('Files must be in format : ' + allowedExtension.join(', '))
                return
            }

            if(sizeInMB > maxSize){
                fileInputError.html('Max size for each file is ' + maxSize + ' MB')
                return
            }

        });


    });
});

$(".input-group").click('click', function() {

    if('{{ @$data->only_one_choice }}' == '1'){

        var dataAttr = ('{{ @$data->transpose_group }}' == '2') ? 'column' : 'row';

        if ($('input[data-'+dataAttr+'-code="'+$(this).data(dataAttr+"-code")+'"]:checked').length > 1) {
            swal('Warning', 'You cannot choose same '+dataAttr+' answer', 'warning');
            $('input[data-'+dataAttr+'-code="'+$(this).data(dataAttr+"-code")+'"]').prop('checked', false);
        }

    }

    return;

    // if('{{ @$data->transpose_group }}' == '2'){

    // }
    // alert($(this).data("column-code"));

    console.log(document.querySelectorAll('[data-column-code='+$(this).data("column-code")+']'));

    var radioNode = document.querySelectorAll('[data-column-code='+$(this).data("column-code")+']');

    radioNode.forEach(  
            function(currentValue, currentIndex, listObj) {
                console.log(currentValue);  
              }, 
            ); 

});
</script>

@endpush