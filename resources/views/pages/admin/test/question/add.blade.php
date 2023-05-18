@extends('layouts.applte')

@section('content')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('assets/lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- CK Editor -->
<script src="{{ asset('assets/lte/bower_components/ckeditor/ckeditor.js') }}"></script>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Recruitment</a></li>
            <li class="active">Data Question</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Question</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form id="add_form" action="{{ route('question.store') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="box-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <table class="form-table" width="100%">
                      <tr>
                        <td colspan="2">
                          <div class="form-group">
                              <label for="step_id">Step <span style="color:red;">*</span></label>
                              <select class="form-control{{ $errors->has('step_id') ? ' is-invalid' : '' }}" name="step_id" id="step_id" style="width: 100%;" required>
                              </select>
                              @if ($errors->has('step_id'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('step_id') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td width="50%">
                          <div class="form-group">
                              <label for="order">Order <span style="color:red;">*</span></label>
                              <input type="number" class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}" name="order" id="order" value="{{ old('order') }}" placeholder="Question Order" required>
                              @if ($errors->has('order'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('order') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                        <td width="50%">
                          <div class="form-group">
                              <label for="column">Column</label>
                              <input type="number" class="form-control{{ $errors->has('column') ? ' is-invalid' : '' }}" name="column" id="column" value="{{ @old('column') ?? 1 }}" placeholder="Column Placing (Default: 1 - 100% width)">
                              @if ($errors->has('column'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('column') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                      </tr>
                    
                      <tr>
                        <td width="50%">
                          <div class="form-group">
                              <label for="alignment">Question Alignment</label>
                              <select class="form-control{{ $errors->has('alignment') ? ' is-invalid' : '' }}" name="alignment" id="alignment" style="width: 100%;">
                                  <option value=1 {{ (old('alignment') == 1) ? 'selected' : '' }}>Horizontal</option>
                                  <option value=2 {{ (old('alignment') == 2) ? 'selected' : '' }}>Vertical</option>
                              </select>
                              @if ($errors->has('alignment'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('alignment') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                        <td width="50%">
                          <div class="form-group" style="display: none;">
                              <label for="required">Required</label>
                              <select class="form-control{{ $errors->has('required') ? ' is-invalid' : '' }}" name="required" id="required" style="width: 100%;">
                                  <option value=1 {{ (old('required') == 1) ? 'selected' : '' }}>Required</option>
                                  <option value=2 {{ (old('required') == 2) ? 'selected' : '' }}>Not Required</option>
                              </select>
                              @if ($errors->has('required'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('required') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                      </tr>
    
                      <tr>
                        <td colspan="2">
                          <div class="form-group">
                              <label for="type">Type <span style="color:red;">*</span></label>
                              <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="type" style="width: 100%;" required>
                                  <option value="">--- Select Type</option>
                                  <option value="Question" {{ (old('type') == 'Question') ? 'selected' : '' }}>Question</option>
                                  <option value="Line Text" {{ (old('type') == 'Line Text') ? 'selected' : '' }}>Line Text</option>
                                  <option value="Image" {{ (old('type') == 'Image') ? 'selected' : '' }}>Image</option>
                              </select>
                              @if ($errors->has('type'))
                                  <span class="invalid-feedback" style="color: red">
                                      <strong>{{ $errors->first('type') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </td>
                      </tr>
                    </table>


                    <br>
                    <div class="box box-primary" id="question_detail">
                      <div class="box-header with-border">
                        <h3 class="box-title">Details</h3>
                      </div>
                      <div class="box-body">

                        <table class="form-table" width="100%">
                          <tr>
                            <td>
                              <div class="form-group" id="fg_answer_type">
                                  <label for="answer_type">Answer Type <span style="color:red;">*</span></label>
                                  <select class="form-control{{ $errors->has('answer_type') ? ' is-invalid' : '' }}" name="answer_type" id="answer_type" style="width: 100%;" required>
                                      <option value="">--- Select Answer Type</option>
                                      <option value="Plain" {{ (old('answer_type') == 'Plain') ? 'selected' : '' }}>Plain</option>
                                      <option value="Choices" {{ (old('answer_type') == 'Choices') ? 'selected' : '' }}>Choices</option>
                                      <option value="Multiple Input" {{ (old('answer_type') == 'Multiple Input') ? 'selected' : '' }}>Multiple Input</option>
                                      <option value="Group" {{ (old('answer_type') == 'Group') ? 'selected' : '' }}>Group</option>
                                      <option value="Upload Files" {{ (old('type') == 'Upload Files') ? 'selected' : '' }}>Upload Files</option>
                                  </select>
                                  @if ($errors->has('answer_type'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('answer_type') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_text">
                                  <label for="text">Question Text</span></label>
                                  <textarea name="text" id="text" class="form-control" rows="5">
                                    {{ @old('text') }}
                                  </textarea>
                                  @if ($errors->has('text'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('text') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_answer_box">
                                  <label for="answer_box">Answer Box</label>
                                  <select class="form-control{{ $errors->has('answer_box') ? ' is-invalid' : '' }}" name="answer_box" id="answer_box" style="width: 100%;">
                                      <option value=1 {{ (old('answer_box') == 1) ? 'selected' : '' }}>Text</option>
                                      <option value=2 {{ (old('answer_box') == 2) ? 'selected' : '' }}>TextArea</option>
                                      <option value=3 {{ (old('answer_box') == 3) ? 'selected' : '' }}>Option</option>
                                  </select>
                                  @if ($errors->has('answer_box'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('answer_box') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_option_list">
                                  <label for="question_option">Option List</span></label>
                                  <input type="text" class="form-control" name="question_option" id="question_option" value="{{ old('question_option') }}" placeholder="Add Option List separated by comma (e.g: 1,2,3)">
                                  @if ($errors->has('question_option'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('question_option') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_answer_width">
                                  <label for="answer_width">Answer Width</span></label>
                                  <input type="text" class="form-control" name="answer_width" id="answer_width" value="{{ old('answer_width') }}" placeholder="Answer Width (in Pixel or Percentage, e.g: 100px, 50%)">
                                  @if ($errors->has('answer_width'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('answer_width') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_choices">
                                  <label>Multiple Choices</span></label>
                                  <table border="1px" width="100%">
                                    <tr>
                                      <td align="center">Action</td>
                                      <td align="center">Answer</td>
                                    </tr>

                                    <tr class="tr_clone_choices" valign="top" style="padding-bottom: 10px;">
                                      <td style="padding: 15px; text-align: center;">
                                          <a href="javascript:void(0);" class="tr_clone_add_choices" title="Add field"><span><i class="fa fa-plus tambah_choices"></i></span></a> 
                                          <a href="javascript:void(0);" class="tr_clone_remove_choices" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus_choices"></i></span></a>
                                      </td>
                                      <td style="padding: 10px;">
                                        <label for="choice_key">Key</span></label>
                                        <input type="text" name="choice_key[]" id="choice_key" class="form-control" value="{{ @old('choice_key')[0] }}">
                                        <br>
                                        
                                        <label for="choice_text">Text</span></label>
                                        <textarea name="choice_text[]" id="choice_text" class="form-control" rows="5">{{ @old('choice_text')[0] }}</textarea>
                                      </td>

                                    </tr>

                                    @if(count(@old('choice_key') ?? []) > 1)

                                      @for($i = 1; $i < count(@old('choice_key') ?? []); $i++)

                                        @if(@old('choice_key')[$i] == null && @old('choice_text')[$i] == null)

                                          <!-- NOTHING -->

                                        @else

                                          <tr class="tr_clone_choices newClassChoices" valign="top" style="padding-bottom: 10px;">
                                            <td style="padding: 15px;">
                                            </td>
                                            <td style="padding: 15px;">
                                              <label for="choice_key">Key</span></label>
                                              <input type="text" name="choice_key[]" id="choice_key_{{ $i }}" class="form-control" value="{{ @old('choice_key')[$i] }}">
                                              <br>
                                              
                                              <label for="choice_text">Text</span></label>
                                              <textarea name="choice_text[]" id="choice_text_{{ $i }}" class="form-control" rows="5">{{ @old('choice_text')[$i] }}</textarea>
                                            </td>

                                          </tr>

                                          <script>
                                            $(function () {
                                                CKEDITOR.replace('choice_text_{{ $i }}');
                                            });
                                          </script>

                                        @endif

                                      @endfor

                                    @endif

                                    
                                  </table>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_multiple_input">
                                  <label>Multiple Answer</span></label>
                                  <table border="1px" width="100%">
                                    <tr>
                                      <td align="center">Action</td>
                                      <td align="center">Key</td>
                                      <td align="center">Field Type</td>
                                      <td align="center">Option List (For 'Option')</td>
                                    </tr>

                                    <tr class="tr_clone_multiple" valign="middle">
                                      <td style="text-align: center;">
                                          <a href="javascript:void(0);" class="tr_clone_add_multiple" title="Add field"><span><i class="fa fa-plus tambah_multiple"></i></span></a> 
                                          <a href="javascript:void(0);" class="tr_clone_remove_multiple" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus_multiple"></i></span></a>
                                      </td>
                                      <td>
                                        <input type="text" name="multiple_key[]" id="multiple_key" class="form-control" value="{{ @old('multiple_key')[0] }}">
                                      </td>
                                      <td>
                                        <select class="form-control" name="multiple_field_type[]" id="multiple_field_type" style="width: 100%;">
                                            <option value=1 {{ @old('multiple_field_type')[0] == 1 }}>Text</option>
                                                <option value=2 {{ @old('multiple_field_type')[0] == 2 }}>Number</option>
                                                <option value=3 {{ @old('multiple_field_type')[0] == 3 }}>TextArea</option>
                                                <option value=4 {{ @old('multiple_field_type')[0] == 4 }}>Date</option>
                                                <option value=5 {{ @old('multiple_field_type')[0] == 5 }}>Option</option>
                                        </select>
                                      </td>
                                      <td>
                                        <input type="text" name="multiple_option_list[]" id="multiple_option_list" class="form-control" placeholder="Separated by comma (e.g : 1,2,3)" value="{{ @old('multiple_option_list')[0] }}">
                                      </td>

                                    </tr>

                                    @if(count(@old('multiple_key') ?? []) > 1)

                                      @for($i = 1; $i < count(@old('multiple_key') ?? []); $i++)

                                        @if(@old('multiple_key')[$i] == null)

                                          <!-- NOTHING -->

                                        @else

                                          <tr class="tr_clone_multiple newClassMultiple" valign="middle">
                                            <td style="text-align: center;">
                                            </td>
                                            <td>
                                              <input type="text" name="multiple_key[]" id="multiple_key_{{ $i }}" class="form-control" value="{{ @old('multiple_key')[$i] }}">
                                            </td>
                                            <td>
                                              <select class="form-control" name="multiple_field_type[]" id="multiple_field_type_{{ $i }}" style="width: 100%;">
                                                  <option value=1 {{ @old('multiple_field_type')[$i] == 1 ? 'selected' : '' }}>Text</option>
                                                  <option value=2 {{ @old('multiple_field_type')[$i] == 2 ? 'selected' : '' }}>Number</option>
                                                  <option value=3 {{ @old('multiple_field_type')[$i] == 3 ? 'selected' : '' }}>TextArea</option>
                                                  <option value=4 {{ @old('multiple_field_type')[$i] == 4 ? 'selected' : '' }}>Date</option>
                                                  <option value=5 {{ @old('multiple_field_type')[$i] == 5 ? 'selected' : '' }}>Option</option>
                                              </select>
                                            </td>
                                            <td>
                                              <input type="text" name="multiple_option_list[]" id="multiple_option_list_{{ $i }}" class="form-control" placeholder="Separated by comma (e.g : 1,2,3)" value="{{ @old('multiple_option_list')[$i] }}">
                                            </td>

                                          </tr>

                                        @endif

                                      @endfor

                                    @endif

                                    
                                  </table>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_answer_alignment">
                                  <label for="answer_alignment">Answer Alignment</span></label>
                                  <select class="form-control" name="answer_alignment" id="answer_alignment" style="width: 100%;">
                                      <option value=1 {{ @old('answer_alignment') == 1 ? 'selected' : '' }}>Horizontal</option>
                                      <option value=2 {{ @old('answer_alignment') == 2 ? 'selected' : '' }}>Vertical</option>
                                  </select>
                                  @if ($errors->has('answer_alignment'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('answer_alignment') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_max_column">
                                  <label for="answer_max_column">Max Column</span></label>
                                  <input type="number" name="answer_max_column" id="answer_max_column" class="form-control" value="{{ @old('answer_max_column') }}">
                                  @if ($errors->has('answer_max_column'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('answer_max_column') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_use_explanation">
                                  <label for="use_explanation">Use Explanation</span></label>
                                  <select class="form-control" name="use_explanation" id="use_explanation" style="width: 100%;">
                                      <option value=1 {{ @old('use_explanation') == 1 ? 'selected' : '' }}>Yes</option>
                                      <option value=2 {{ @old('use_explanation') == 2 ? 'selected' : '' }}>No</option>
                                  </select>
                                  @if ($errors->has('use_explanation'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('use_explanation') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_right_answer">
                                  <label for="right_answer">Right Answer</span></label>
                                  <input type="text" class="form-control{{ $errors->has('right_answer') ? ' is-invalid' : '' }}" name="right_answer" id="right_answer" value="{{ old('right_answer') }}" placeholder="Right Answer">
                                  @if ($errors->has('right_answer'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('right_answer') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_score">
                                  <label for="score">Score</span></label>
                                  <input type="text" class="form-control{{ $errors->has('score') ? ' is-invalid' : '' }}" name="score" id="score" value="{{ old('score') }}" placeholder="Score">
                                  @if ($errors->has('score'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('score') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_group_answer_row">
                                  <label>Group Answer Row</span></label>
                                  <table border="1px" width="100%">
                                    <tr>
                                      <td width="15%" align="center">Action</td>
                                      <td align="center">Row</td>
                                      
                                    </tr>

                                    <tr class="tr_clone_ga_row" valign="middle">
                                      <td style="text-align: center;">
                                          <a href="javascript:void(0);" class="tr_clone_add_ga_row" title="Add field"><span><i class="fa fa-plus tambah_ga_row"></i></span></a> 
                                          <a href="javascript:void(0);" class="tr_clone_remove_ga_row" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus_ga_row"></i></span></a>
                                      </td>
                                      <td>
                                        <input type="text" name="group_answer_row_text[]" id="group_answer_row_text" class="form-control" value="{{ @old('group_answer_row_text')[0] }}">
                                      </td>
                                      

                                    </tr>

                                    @if(count(@old('group_answer_row_text') ?? []) > 1)

                                      @for($i = 1; $i < count(@old('group_answer_row_text') ?? []); $i++)

                                        @if(@old('group_answer_row_text')[$i] == null)

                                          <!-- NOTHING -->

                                        @else

                                          <tr class="tr_clone_ga_row newClassGaRow" valign="middle">
                                            <td style="text-align: center;">
                                            </td>
                                            <td>
                                              <input type="text" name="group_answer_row_text[]" id="group_answer_row_text_{{ $i }}" class="form-control" value="{{ @old('group_answer_row_text')[$i] }}">
                                            </td>
                                            

                                          </tr>

                                        @endif

                                      @endfor

                                    @endif

                                    
                                  </table>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_group_answer_column">
                                  <label>Group Answer Column</span></label>
                                  <table border="1px" width="100%">
                                    <tr>
                                      <td width="15%" align="center">Action</td>
                                      <td align="center">Column</td>
                                    </tr>

                                    <tr class="tr_clone_ga_column" valign="middle">
                                      <td style="text-align: center;">
                                          <a href="javascript:void(0);" class="tr_clone_add_ga_column" title="Add field"><span><i class="fa fa-plus tambah_ga_column"></i></span></a> 
                                          <a href="javascript:void(0);" class="tr_clone_remove_ga_column" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus_ga_column"></i></span></a>
                                      </td>
                                      <td>
                                        <input type="text" name="group_answer_column_text[]" id="group_answer_column_text" class="form-control" value="{{ @old('group_answer_column_text')[0] }}">
                                      </td>

                                    </tr>

                                    @if(count(@old('group_answer_column_text') ?? []) > 1)

                                      @for($i = 1; $i < count(@old('group_answer_column_text') ?? []); $i++)

                                        @if(@old('group_answer_column_text')[$i] == null)

                                          <!-- NOTHING -->

                                        @else

                                          <tr class="tr_clone_ga_column newClassGaColumn" valign="middle">
                                            <td style="text-align: center;">
                                            </td>
                                            <td>
                                              <input type="text" name="group_answer_column_text[]" id="group_answer_column_text_{{ $i }}" class="form-control" value="{{ @old('group_answer_column_text')[$i] }}">
                                            </td>

                                          </tr>

                                        @endif

                                      @endfor

                                    @endif

                                    
                                  </table>
                                </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_group_answer_type">
                                  <label for="group_answer_type">Group Answer Type</span></label>
                                  <select class="form-control" name="group_answer_type" id="group_answer_type" style="width: 100%;">
                                      <option value=1 {{ @old('group_answer_type') == 1 ? 'selected' : '' }}>Text</option>
                                      <option value=2 {{ @old('group_answer_type') == 2 ? 'selected' : '' }}>Radio</option>
                                  </select>
                                  @if ($errors->has('group_answer_type'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('group_answer_type') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr id="fg_ga_scoring">
                            <td style="padding-bottom: 15px;padding-top: 5px;">
                              <button style="width: 100%;" type="button" class="btn btn-primary" onclick="setScore()">Set Answer and Score</button>
                            </td>
                          </tr>

                          <tr id="fg_ga_score_set">
                            @if((count(@old('group_answer_column_right_answer') ?? []) > 0 || count(@old('group_answer_column_score') ?? []) > 0) && (@old('group_answer_type') == 1))
                              <td>
                                <table class="table">
                                  <tr style="font-weight: bold;">
                                    <td class="col-3">Field</td>
                                    <td class="col-3">Right Answer (can be emptied)</td>
                                    <td class="col-3">Score (can be emptied)</td>
                                    <td class="col-3">Disabled?</td>
                                  </tr>

                                  <?php $count_ga = 0; ?>
                                  @for($i = 0; $i < count(@old('group_answer_row_text') ?? []); $i++)
                                    @for($j = 0; $j < count(@old('group_answer_column_text') ?? []); $j++)
                                      <tr>
                                        <td class="col-3"><span>{{ @old('group_answer_row_text')[$i] }} - {{ @old('group_answer_column_text')[$j] }}</span></td>
                                        <td class="col-3"><input type="text" name="group_answer_column_right_answer[]" id="group_answer_column_right_answer_{{ $count_ga }}" class="form-control" placeholder="Right Answer" value="{{ @old('group_answer_column_right_answer')[$count_ga] }}"></td>
                                        <td class="col-3"><input type="text" name="group_answer_column_score[]" id="group_answer_column_score{{ $count_ga }}" class="form-control" placeholder="Score" value="{{ @old('group_answer_column_score')[$count_ga] }}"></td>
                                        <td class="col-3">
                                          <select class="form-control" name="group_answer_column_disabled[]" id="group_answer_column_disabled" style="width: 100%;">
                                              <option value=0 {{ @old('group_answer_column_disabled')[$count_ga] == 0 ? 'selected' : '' }}>No</option>
                                              <option value=1 {{ @old('group_answer_column_disabled')[$count_ga] == 1 ? 'selected' : '' }}>Yes</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <?php $count_ga += 1; ?>
                                    @endfor
                                  @endfor

                                </table>
                              </td>
                            @endif
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_transpose_group">
                                  <label for="transpose_group">Transpose Group</span></label>
                                  <select class="form-control" name="transpose_group" id="transpose_group" style="width: 100%;">
                                      <option value=2 {{ @old('transpose_group') == 2 ? 'selected' : '' }}>No</option>
                                      <option value=1 {{ @old('transpose_group') == 1 ? 'selected' : '' }}>Yes</option>
                                  </select>
                                  @if ($errors->has('transpose_group'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('transpose_group') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_only_one_choice">
                                  <label for="only_one_choice">Only One Choice</span></label>
                                  <select class="form-control" name="only_one_choice" id="only_one_choice" style="width: 100%;">
                                      <option value=2 {{ @old('only_one_choice') == 2 ? 'selected' : '' }}>No</option>
                                      <option value=1 {{ @old('only_one_choice') == 1 ? 'selected' : '' }}>Yes</option>
                                  </select>
                                  @if ($errors->has('only_one_choice'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('only_one_choice') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_line_text">
                                  <label for="line_text">Line Text</span></label>
                                  <textarea class="form-control{{ $errors->has('line_text') ? ' is-invalid' : '' }}" name="line_text" id="line_text" placeholder="line_text Text"  cols="5" rows="2">{{ old('line_text') }}</textarea>
                                  @if ($errors->has('line_text'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('line_text') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group" id="fg_image">
                                  <label for="image_url">Image <span style="color: blue; font-size: 12px;">(Extension : .jpg, .jpeg, .png | Max Size : 2 MB)</span></label>
                                  <input type="file" class="form-control{{ $errors->has('image_url') ? ' is-invalid' : '' }}" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="Question image_url">
                                  @if ($errors->has('image_url'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('image_url') }}</strong>
                                      </span>
                                  @endif

                                  @if($errors->has('step_id') || $errors->has('order') || $errors->has('type') || $errors->has('answer_type'))
                                    <br>
                                    <div class="alert alert-warning">Your submission was not complete, please upload your file again.</div>
                                  @endif
                              </div>
                            </td>

                          </tr>

                          <tr id="fg_image_height">
                            <td>
                              <div class="form-group">
                                  <label for="image_height">Height</label>
                                  <input type="number" class="form-control{{ $errors->has('image_height') ? ' is-invalid' : '' }}" name="image_height" id="image_height" value="{{ @old('image_height') }}" placeholder="Image Max Height in Pixel (px)">
                                  @if ($errors->has('image_height'))
                                      <span class="invalid-feedback" style="color: red">
                                          <strong>{{ $errors->first('image_height') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </td>
                          </tr>

                          
                        </table>

                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('main.save')</button>
                    <button type="button" class="btn btn-success" onclick="saveAndMore()">Save & Input More</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('question.index') }}'">@lang('main.cancel')</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection

@push('admin_styles')

<style type="text/css">

.form-table tr td{
  padding-left: 10px;
  padding-right: 10px;
}

</style>

@endpush

@push('admin_scripts')

<script>
$(document).ready( function () {

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#step_id').select2(setOptions('{{ route("step.data") }}', '-- Choose Step --', function (params) {return filterData('q', params.term);
      }, function (data, params) {
          return {
              results: $.map(data, function (obj) { 
                console.log(obj);                               
                  return {id: obj.id, text: obj.module.name + ' - ' + obj.name}
              })
          }
      }));

      reset_type('{{ @old('type') }}');
});

$(function () {
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        startDate: '-3d'
    });
});

$(function () {
    CKEDITOR.replace('line_text');
    CKEDITOR.replace('choice_text');
    CKEDITOR.replace('text');
});

function reset_type(type = '') {

  $("#answer_type").prop('required', false);

  $('#question_detail').hide();
  $('#fg_line_text').hide();
  $('#fg_image').hide();
  $('#fg_image_height').hide();
  $('#fg_answer_type').hide();
  
  // RESET FIELDS
  $('#line_text').html('{!! @old('line_text') ?? null !!}');
  $('#image_url').val(null);
  $('#answer_type').val('{{ @old('answer_type') ?? null }}');

  reset_answer_type('{{ @old('answer_type') }}');

  if(type == 'Question') {
    $('#fg_answer_type').show();
    $("#answer_type").prop('required', true);
  }
  if(type == 'Line Text') $('#fg_line_text').show();
  if(type == 'Image'){
    $('#fg_image').show();
    $('#fg_image_height').show();
  }

  if(type != '') $('#question_detail').show();

}

function reset_answer_type(answer_type = '') {

  toggle_option_list(('{{ ((@old('answer_box') ?? 1) == 3) }}') && (answer_type == 'Plain'));
  toggle_group_answer_type(('{{ ((@old('group_answer_type') ?? 1) == 2) }}') && (answer_type == 'Group'));
  toggle_max_column(('{{ ((@old('answer_alignment') ?? 1) == 1) }}') && (answer_type == 'Choices'));

  $('#fg_text').hide();
  $('#fg_answer_box').hide();
  $('#fg_answer_width').hide();

  $('#fg_answer_alignment').hide();
  $('#fg_max_column').hide();
  $('#fg_use_explanation').hide();
  $('#fg_choices').hide();

  $('#fg_right_answer').hide();
  $('#fg_score').hide();

  $('#fg_multiple_input').hide();

  $('#fg_group_answer_column').hide();
  $('#fg_group_answer_row').hide();
  $('#fg_ga_scoring').hide();
  $('#fg_ga_score_set').hide();
  $('#fg_group_answer_type').hide();
  $('#fg_transpose_group').hide();
  $('#fg_only_one_choice').hide();


  // RESET FIELDS
  $('#text').html('{!! @old('text') ?? null !!}');
  $('#answer_box').val('{{ @old('answer_box') ?? 1 }}');
  $('#answer_width').val('{{ @old('answer_width') ?? null }}');
  $('#right_answer').val('{{ @old('right_answer') ?? null }}');
  $('#score').val('{{ @old('score') ?? null }}');
  $('#answer_alignment').val('{{ @old('answer_alignment') ?? 1 }}');
  $('#answer_max_column').val('{{ @old('answer_max_column') ?? 1 }}');
  $('#use_explanation').val('{{ @old('use_explanation') ?? 1 }}');

  $('#transpose_group').val('{{ @old('transpose_group') ?? 2 }}');
  $('#only_one_choice').val('{{ @old('only_one_choice') ?? 2 }}');
  $('#group_answer_type').val('{{ @old('group_answer_type') ?? 1 }}');

  if(answer_type == 'Plain'){
    $('#fg_text').show();
    $('#fg_answer_box').show();
    $('#fg_answer_width').show();
    $('#fg_right_answer').show();
    $('#fg_score').show();
  }else if(answer_type == 'Choices'){
    $('#fg_text').show();
    $('#fg_choices').show();
    $('#fg_answer_alignment').show();
    $('#fg_max_column').show();
    $('#fg_use_explanation').show();
    $('#fg_right_answer').show();
    $('#fg_score').show();
  }else if(answer_type == 'Multiple Input'){
    $('#fg_text').show();
    $('#fg_multiple_input').show();
  }else if(answer_type == 'Group'){
    $('#fg_text').show();
    $('#fg_group_answer_column').show();
    $('#fg_group_answer_row').show();
    $('#fg_group_answer_type').show();
    $('#fg_ga_scoring').show();
    $('#fg_ga_score_set').show();
    // $('#fg_transpose_group').show();
    // $('#fg_only_one_choice').show();

    if('{{ @old('group_answer_type') }}' == '1'){
      $('#fg_ga_scoring').show();
      $('#fg_ga_score_set').show();
    }else if('{{ @old('group_answer_type') }}' == '2'){
      $('#fg_transpose_group').show();
      $('#fg_only_one_choice').show();
      $('#fg_ga_score_set').hide();
      $('#fg_ga_scoring').hide();
    }
  }else if(answer_type == 'Upload Files'){
    $('#fg_text').show();
    $('#fg_answer_width').show();
  }
}

function toggle_max_column(active = false) {
  $('#fg_max_column').hide();
  $('#answer_max_column').val(null);
  if(active){
    $('#answer_max_column').val('{{ @old('answer_max_column') ?? 1 }}');
    $('#fg_max_column').show();
  }
}

function toggle_option_list(active = false) {
  $('#fg_option_list').hide();
  $('#question_option').val('{{ @old('question_option') ?? null }}');
  if(active) $('#fg_option_list').show();
}

function toggle_group_answer_type(active = false) {
  $('#fg_transpose_group').hide();
  $('#fg_only_one_choice').hide();
  $('#fg_ga_scoring').hide();
  $('#fg_ga_score_set').hide();

  $('#transpose_group').val(null);
  $('#only_one_choice').val(null);

  if(active){
    $('#transpose_group').val('{{ @old('transpose_group') ?? 2 }}');
    $('#only_one_choice').val('{{ @old('only_one_choice') ?? 2 }}');

    $('#fg_transpose_group').show();
    $('#fg_only_one_choice').show();
  }else{
    $('#fg_ga_scoring').show();
    $('#fg_ga_score_set').show();
  }
}

function full_reset_type() {
    CKEDITOR.instances.line_text.setData(null);
    $('#image_url').val(null);
    $('#answer_type').val(null);

    CKEDITOR.instances.text.setData(null);
    $('#answer_box').val(1);
    $('#answer_width').val(null);
    $('#right_answer').val(null);
    $('#score').val(null);
    $('#answer_alignment').val(1);
    $('#answer_max_column').val(1);
    $('#use_explanation').val(1);

    $('#transpose_group').val(2);
    $('#only_one_choice').val(2);
    $('#group_answer_type').val(1);
    $('#question_option').val(null);

}

function full_reset_answer_type() {
    CKEDITOR.instances.text.setData(null);
    $('#answer_box').val(1);
    $('#answer_width').val(null);
    $('#right_answer').val(null);
    $('#score').val(null);
    $('#answer_alignment').val(1);
    $('#answer_max_column').val(1);
    $('#use_explanation').val(2);

    $('#transpose_group').val(2);
    $('#only_one_choice').val(2);
    $('#group_answer_type').val(1);
    $('#question_option').val(null);

    // REMOVE newClass
    $('.newClass').remove();
    $('.newClassChoices').remove();
    $('.newClassMultiple').remove();
    $('.newClassGaColumn').remove();
    $('.newClassGaRow').remove();


}

$(document.body).on("change", "#type" ,function(){
    reset_type(this.value);

    full_reset_type();
});

$(document.body).on("change", "#answer_type" ,function(){
    reset_answer_type(this.value);

    full_reset_answer_type();
});

$(document.body).on("change", "#answer_alignment" ,function(){
    toggle_max_column();
    if(this.value == 1) toggle_max_column(true);
});

$(document.body).on("change", "#answer_box" ,function(){
    toggle_option_list();
    if(this.value == 3) toggle_option_list(true);
});

$(document.body).on("change", "#group_answer_type" ,function(){
    toggle_group_answer_type();
    if(this.value == 2) toggle_group_answer_type(true);
});

$(document).ready(function(){
    //Cloning
  $(".tr_clone_add").click('click', function() {
      var $tr    = $(this).closest('.tr_clone');
      var newClass='newClass';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      $tr.after($clone);
      $(".tambah:last").remove(); //Remove field html
      $(".hapus:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
  });

  $(".tr_clone_remove").click('click', function() { //Once remove button is clicked
      $(".newClass:last").remove(); //Remove field html
  });

});

$(document).ready(function(){
    //Cloning
  $(".tr_clone_add_choices").click('click', function() {
      var code = Math.floor(Date.now() / 1000) + '' + Math.floor((Math.random() * 1000) + 1);
      var $tr    = $(this).closest('.tr_clone_choices');
      var newClass='newClassChoices';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      $clone.find('textarea').attr('id', 'choice_text_' + code);
      $clone.find('div').remove();
      // $tr.after($clone);

      var newElement = $('.newClassChoices:last');
      if(newElement.length == 0){
        $tr.after($clone);
      }else{
        newElement.after($clone);
      }

      CKEDITOR.replace('choice_text_' + code);

      $(".tambah_choices:last").remove(); //Remove field html
      $(".hapus_choices:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
  });

  $(".tr_clone_remove_choices").click('click', function() { //Once remove button is clicked
      $(".newClassChoices:last").remove(); //Remove field html
  });

});

$(document).ready(function(){
    //Cloning
  $(".tr_clone_add_multiple").click('click', function() {
      // var $tr    = $(this).closest('.tr_clone_multiple');
      var $tr    = $(this).closest('.tr_clone_multiple');
      var newClass='newClassMultiple';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      // $tr.after($clone);

      var newElement = $('.newClassMultiple:last');
      if(newElement.length == 0){
        $tr.after($clone);
      }else{
        newElement.after($clone);
      }

      $(".tambah_multiple:last").remove(); //Remove field html
      $(".hapus_multiple:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
  });

  $(".tr_clone_remove_multiple").click('click', function() { //Once remove button is clicked
      $(".newClassMultiple:last").remove(); //Remove field html
  });

});

$(document).ready(function(){
    //Cloning
  $(".tr_clone_add_ga_column").click('click', function() {
      var $tr    = $(this).closest('.tr_clone_ga_column');
      var newClass='newClassGaColumn';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      // $tr.after($clone);

      var newElement = $('.newClassGaColumn:last');
      if(newElement.length == 0){
        $tr.after($clone);
      }else{
        newElement.after($clone);
      }

      $(".tambah_ga_column:last").remove(); //Remove field html
      $(".hapus_ga_column:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
  });

  $(".tr_clone_remove_ga_column").click('click', function() { //Once remove button is clicked
      $(".newClassGaColumn:last").remove(); //Remove field html
  });

});

$(document).ready(function(){
    //Cloning
  $(".tr_clone_add_ga_row").click('click', function() {
      var $tr    = $(this).closest('.tr_clone_ga_row');
      var newClass='newClassGaRow';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      // $tr.after($clone);

      var newElement = $('.newClassGaRow:last');
      if(newElement.length == 0){
        $tr.after($clone);
      }else{
        newElement.after($clone);
      }

      $(".tambah_ga_row:last").remove(); //Remove field html
      $(".hapus_ga_row:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
  });

  $(".tr_clone_remove_ga_row").click('click', function() { //Once remove button is clicked
      $(".newClassGaRow:last").remove(); //Remove field html
  });

});


function saveAndMore() {
  var input = $("<input>").attr("type", "hidden").attr("name", "input_more").val(1);
  $('#add_form').append($(input));
  $('#add_form').submit();  
}

function setScore(row = null, col = null) {

  var go = false;
  var content = '<td><table class="table">';

  if(row == null) row = fetchArrayValue('group_answer_row_text[]');
  if(col == null) col = fetchArrayValue('group_answer_column_text[]');

  if((row.length == 1 && (row[0] == null || row[0] == "")) || (col.length == 1 && (col[0] == null || col[0] == ""))) return;

  if((document.getElementsByName("group_answer_column_right_answer[]")[0] && document.getElementsByName("group_answer_column_right_answer[]")[0].value) || (document.getElementsByName("group_answer_column_score[]")[0] && document.getElementsByName("group_answer_column_score[]")[0].value)){
      swal({
          title: "Are you sure?",
          text: "There are some data that will be overwritten",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, overwrite it",
          cancelButtonText: "No, cancel",
          closeOnConfirm: true,
          closeOnCancel: true
      },
      function (isConfirm) {
          if (isConfirm) {
            content += '<tr style="font-weight: bold;"><td class="col-4">Field</td><td class="col-4">Right Answer (can be emptied)</td><td class="col-4">Score (can be emptied)</td>';

            for(var i = 0;i < row.length; i++){

              for(var j = 0;j < col.length; j++){

                if((row[i] == null || row[i] == "") && (col[i] == null || col[i] == "")) continue;
                
                content += '<tr>';
                content += '<td class="col-3"><span>' + row[i] + ' - ' + col[j] + '</span></td>';
                content += '<td class="col-3"><input type="text" name="group_answer_column_right_answer[]" id="group_answer_column_right_answer_'+j+'" class="form-control" placeholder="Right Answer"></td>';
                content += '<td class="col-3"><input type="number" name="group_answer_column_score[]" id="group_answer_column_score_'+j+'" class="form-control" placeholder="Score"></td>';
                content += '<td class="col-3">';
                content += '<select class="form-control" name="group_answer_column_disabled[]" id="group_answer_column_disabled" style="width: 100%;">';
                content += '<option value=0 selected>No</option>';
                content += '<option value=1>Yes</option>';
                content += '</select>';
                content += '</td>';
                content += '</tr>';
                
              }

              
            }

            content += '</table></td>';

            $('#fg_ga_score_set').html(content);
            $('#fg_ga_score_set').show();
          } else{
            //
          }
      });
  }else{
    content += '<tr style="font-weight: bold;"><td class="col-3">Field</td><td class="col-3">Right Answer (can be emptied)</td><td class="col-3">Score (can be emptied)</td><td class="col-3">Disabled?</td>';

    for(var i = 0;i < row.length; i++){

      for(var j = 0;j < col.length; j++){

        if((row[i] == null || row[i] == "") && (col[i] == null || col[i] == "")) continue;
        
        content += '<tr>';
        content += '<td class="col-3"><span>' + row[i] + ' - ' + col[j] + '</span></td>';
        content += '<td class="col-3"><input type="text" name="group_answer_column_right_answer[]" id="group_answer_column_right_answer_'+j+'" class="form-control" placeholder="Right Answer"></td>';
        content += '<td class="col-3"><input type="number" name="group_answer_column_score[]" id="group_answer_column_score_'+j+'" class="form-control" placeholder="Score"></td>';
        content += '<td class="col-3">';
        content += '<select class="form-control" name="group_answer_column_disabled[]" id="group_answer_column_disabled" style="width: 100%;">';
        content += '<option value=0 selected>No</option>';
        content += '<option value=1>Yes</option>';
        content += '</select>';
        content += '</td>';
        content += '</tr>';
        
      }

      
    }

    content += '</table></td>';

    $('#fg_ga_score_set').html(content);
    $('#fg_ga_score_set').show();
  }
  
}

function fetchArrayValue(element) { 
  var elem = document.getElementsByName(element);
  var result = [];

  for (var i = 0; i < elem.length; ++i) {
    if (typeof elem[i].value !== "undefined") {
        result.push(elem[i].value);
      }
    }

  return result;
}

</script>

@endpush
