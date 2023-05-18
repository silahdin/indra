<?php
namespace App\Http\Controllers\TestOnline;

use App\Filters\TestQuestionFilters;
use App\Http\Controllers\Controller;
use App\Models\TestGroupAnswerColumn;
use App\Models\TestGroupAnswerRow;
use App\Models\TestMultipleChoice;
use App\Models\TestMultipleInput;
use App\Models\TestQuestion;
use App\Models\TestUserAnswer;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TestQuestionController extends Controller
{
    public function index()
    {
        return $this->view_page('pages.admin.test.question.index');
    }

    public function datatable(Request $request)
    {
        return DataTables::of(TestQuestion::with('step.module'))
                ->editColumn('type', function($item){
                    $type = $item->type;
                    if($type == 'Question') $type .= ' - ' . $item->answer_type;

                    return $type;
                })
                ->editColumn('alignment', function($item){
                    return ($item->alignment == 1) ? 'Horizontal' : 'Vertical';
                })
                ->addColumn('action', function($item){
                    return
                        '<a style="color: white;margin-left: 4px;" title="Preview" href="'.route('question.preview', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-primary"><span class="fa fa-search"></span></a>' . 
                        '<a style="color: white;margin-left: 4px; margin-right: 4px;" title="Ubah Data" href="'.route('question.edit', Crypt::encrypt($item->id)).'" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>' . 
                        "<button title='Hapus Data' class='btn btn-danger btn-sm btn-delete deleteButton' data-toggle='confirmation' data-singleton='true' value='".Crypt::encrypt($item->id)."'><i class='fa fa-trash'></i></button>";
                })
                ->make(true);
    }

    public function data(TestQuestionFilters $filters)
    {
        return TestQuestion::with('step.module')->filter($filters)->get();
    }

    public function add()
    {
        return $this->view_page('pages.admin.test.question.add');
    }

    public function store(Request $request){

        // return $request->all();

        $this->validate($request, [
            'step_id'       => 'required|exists:test_steps,id',
            'type'          => 'required',
            'order'          => 'required',
        ],
        [
            'step_id.required' => 'The Step field is required', 
        ]);

        if($request->type == 'Question'){
            
            $this->validate($request, [
                'answer_type'   => 'required',
            ]);
        }

        if($request->type == 'Image'){
            
            $this->validate($request, [
                'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ]);
        }

        // CREATE QUESTION
        $data = TestQuestion::create([
            'step_id' => $request->step_id,
            'type' => $request->type,
            'required' => $request->required,
            'order' => $request->order,
            'column' => $request->column,
            'alignment' => $request->alignment,
        ]);

        // LINE TEXT
        if($request->type == 'Line Text')
            $data->update(['line_text' => $this->texting($request->line_text)]);

        // IMAGE
        if($request->type == 'Image'){

            /* UPLOAD LAMPIRAN */
            if($request->file('image_url')){
                $file = $request->file('image_url');
                $name = Carbon::now()->timestamp . '_' . $file->getClientOriginalName();
                $path = 'uploads/question_images';
                $path_for_db = url($path) . '/' . $name;
                $file->move(public_path($path), $name);

                $data->update([
                    'image_url' => $path_for_db,
                    'image_height' => $request->image_height
                ]);
            }

        }

        // QUESTION
        if($request->type == 'Question'){

            // ADD TEXT
            $data->update(['text' => $this->texting($request->text)]);

            // ANSWER TYPE
            if(isset($request->answer_type) && $request->answer_type != null)
                $data->update(['answer_type' => $request->answer_type]);

            // UPLOAD FILES
            if($request->answer_type == 'Upload Files'){
                $data->update([
                    'answer_width' => $request->answer_width,
                ]);
            }

            // PLAIN
            if($request->answer_type == 'Plain'){
                $data->update([
                    'plain_type' => $request->answer_box,
                    'question_option' => $request->question_option,
                    'answer_width' => $request->answer_width,
                    'right_answer' => $request->right_answer,
                    'score' => $request->score,
                ]);
            }

            // CHOICES
            if($request->answer_type == 'Choices'){
                $data->update([
                    'answer_alignment' => $request->answer_alignment,
                    'use_explanation' => $request->use_explanation,
                    'answer_max_column' => $request->answer_max_column,
                    'right_answer' => $request->right_answer,
                    'score' => $request->score,
                ]);

                // GENERATE CHOICE
                for ($i = 0; $i < count(@$request->choice_key ?? []); $i++) { 
                    if($request->choice_key[$i] != null){
                        TestMultipleChoice::create([
                            'question_id' => $data->id,
                            'key' => $request->choice_key[$i],
                            'text' => $this->texting($request->choice_text[$i]),
                        ]);
                    }
                }
            }

            // MULTIPLE INPUT
            if($request->answer_type == 'Multiple Input'){
                
                // GENERATE MULTIPLE INPUT
                for ($i = 0; $i < count(@$request->multiple_key ?? []); $i++) { 
                    if($request->multiple_key[$i] != null && $request->multiple_field_type[$i] != null){
                        $multiple = TestMultipleInput::create([
                            'question_id' => $data->id,
                            'key' => $request->multiple_key[$i],
                            'type' => $request->multiple_field_type[$i],
                            'option_list' => @$request->multiple_option_list[$i] ?? null,
                        ]);

                        // UPDATE MULTIPLE INPUT CODE
                        $multiple->update(['code' => 'MI' . $multiple->id . $this->randomize()]);
                    }
                }
            }

            // GROUP ANSWER
            if($request->answer_type == 'Group'){
                $data->update([
                    'group_answer_type' => $request->group_answer_type,
                    'transpose_group' => $request->transpose_group,
                    'only_one_choice' => $request->only_one_choice,
                ]);

                // GENERATE GROUP CODE
                $column_code = [];
                $row_code = [];
                for ($i = 0; $i < count(@$request->group_answer_row_text ?? []); $i++) {
                    $row_code[$request->group_answer_row_text[$i]] = 'CR' . $i . $this->randomize();
                }

                for ($i = 0; $i < count(@$request->group_answer_column_text ?? []); $i++) {
                    $column_code[$request->group_answer_column_text[$i]] = 'CC' . $i . $this->randomize();
                }

                // GENERATE GROUP ROW
                $count_ga = 0;
                for ($i = 0; $i < count(@$request->group_answer_row_text ?? []); $i++) { 
                    if($request->group_answer_row_text[$i] != null){
                        $group_row = TestGroupAnswerRow::create([
                            'question_id' => $data->id,
                            'text' => $this->texting($request->group_answer_row_text[$i])
                        ]);

                        // GROUP CODE : ROW
                        $group_row->update(['group_code' => @$row_code[$request->group_answer_row_text[$i]]]);

                        // GENERATE GROUP COLUMN
                        for ($j = 0; $j < count(@$request->group_answer_column_text ?? []); $j++) { 
                            if($request->group_answer_column_text[$j] != null){
                                $group_column = TestGroupAnswerColumn::create([
                                    'group_answer_row_id' => $group_row->id,
                                    'text' => $this->texting($request->group_answer_column_text[$j]),
                                    'right_answer' => @$request->group_answer_column_right_answer[$count_ga],
                                    'score' => @$request->group_answer_column_score[$count_ga],
                                    'disabled' => @$request->group_answer_column_disabled[$count_ga],
                                ]);

                                // UPDATE GROUP COLUMN CODE
                                $group_column->update([
                                    'code' => 'GC' . $group_column->id . $this->randomize(),
                                    'group_code' => @$column_code[$request->group_answer_column_text[$j]]
                                ]);

                                $count_ga += 1;
                            }
                        }

                    }
                }

                
            }
                
        }

        // UPDATE QUESTION CODE
        $data->update(['code' => 'QN' . $data->id . $this->randomize()]);

        Session::flash('success', 'Question Berhasil Ditambahkan.');

        if(isset($request->input_more) && $request->input_more == 1)
             return redirect()->route('question.add');

        return redirect()->route('question.index');
    }

    public function edit($id){
        
        $decId = $this->decrypt($id, 'question.index');

        // return $decId;

        $data = TestQuestion::with('step', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereId($decId)->first();

        // return $data;

        if(!$data) return redirect(route('question.index'));

        return $this->view_page('pages.admin.test.question.edit', ['data' => $data]);

    }

    public function update(Request $request, $id){

        // return $request->all();

        $decId = $this->decrypt($id, 'question.index');
        
        $this->validate($request, [
            'step_id'       => 'required|exists:test_steps,id',
            'type'          => 'required',
            'type'          => 'required',
        ],
        [
            'step_id.required' => 'The Step field is required', 
        ]);

        if($request->type == 'Question'){
            
            $this->validate($request, [
                'answer_type'   => 'required',
            ]);
        }

        if($request->type == 'Image'){
            
            $this->validate($request, [
                'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ]);
        }

        $data = TestQuestion::whereId($decId)->first();

        if(!$data) return redirect(route('question.index'));

        // UPDATE
        $data->update([
            'step_id' => $request->step_id,
            'type' => $request->type,
            'required' => $request->required,
            'alignment' => $request->alignment,
            'order' => $request->order,
            'column' => $request->column
        ]);

        // LINE TEXT
        if($request->type == 'Line Text')
            $data->update(['line_text' => $this->texting($request->line_text)]);

        // IMAGE
        if($request->type == 'Image'){

            $data->update(['image_height' => $request->image_height]);

            /* UPLOAD LAMPIRAN */
            if($request->file('image_url')){
                $file = $request->file('image_url');
                $name = Carbon::now()->timestamp . '_' . $file->getClientOriginalName();
                $path = 'uploads/question_images';
                $path_for_db = url($path) . '/' . $name;
                $file->move(public_path($path), $name);

                $data->update(['image_url' => $path_for_db]);
            }

        }

        // PURGE ALL ANSWER & QUESTION
        $garIds = TestGroupAnswerRow::whereQuestionId($data->id)->pluck('id')->toArray();
        $gacIds = TestGroupAnswerColumn::whereIn('group_answer_row_id', $garIds)->pluck('id')->toArray();
        $mtpIds = TestMultipleInput::whereQuestionId($data->id)->pluck('id')->toArray();

        // ANSWER
        TestUserAnswer::whereQuestionId($data->id)->delete();
        TestUserAnswer::whereIn('group_answer_column_id', $gacIds)->delete();
        TestUserAnswer::whereIn('multiple_input_id', $mtpIds)->delete();

        // QUESTION
        TestMultipleChoice::whereQuestionId($data->id)->delete();
        TestMultipleInput::whereQuestionId($data->id)->delete();
        TestGroupAnswerColumn::whereIn('group_answer_row_id', $garIds)->delete();
        TestGroupAnswerRow::whereQuestionId($data->id)->delete();

        // GENERATE QUESTION AGAIN
        if($request->type == 'Question'){

            // ADD TEXT
            $data->update(['text' => $this->texting($request->text)]);

            // ANSWER TYPE
            if(isset($request->answer_type) && $request->answer_type != null)
                $data->update(['answer_type' => $request->answer_type]);

            // UPLOAD FILES
            if($request->answer_type == 'Upload Files'){
                $data->update([
                    'answer_width' => $request->answer_width,
                ]);
            }

            // PLAIN
            if($request->answer_type == 'Plain'){
                $data->update([
                    'plain_type' => $request->answer_box,
                    'question_option' => $request->question_option,
                    'answer_width' => $request->answer_width,
                    'right_answer' => $request->right_answer,
                    'score' => $request->score,
                ]);
            }

            // CHOICES
            if($request->answer_type == 'Choices'){
                $data->update([
                    'answer_alignment' => $request->answer_alignment,
                    'use_explanation' => $request->use_explanation,
                    'answer_max_column' => $request->answer_max_column,
                    'right_answer' => $request->right_answer,
                    'score' => $request->score,
                ]);

                // GENERATE CHOICE
                for ($i = 0; $i < count(@$request->choice_key ?? []); $i++) { 
                    if($request->choice_key[$i] != null){
                        TestMultipleChoice::create([
                            'question_id' => $data->id,
                            'key' => $request->choice_key[$i],
                            'text' => $this->texting($request->choice_text[$i]),
                        ]);
                    }
                }
            }

            // MULTIPLE INPUT
            if($request->answer_type == 'Multiple Input'){
                
                // GENERATE MULTIPLE INPUT
                for ($i = 0; $i < count(@$request->multiple_key ?? []); $i++) { 
                    if($request->multiple_key[$i] != null && $request->multiple_field_type[$i] != null){
                        $multiple = TestMultipleInput::create([
                            'question_id' => $data->id,
                            'key' => $request->multiple_key[$i],
                            'type' => $request->multiple_field_type[$i],
                            'option_list' => @$request->multiple_option_list[$i] ?? null,
                        ]);

                        // UPDATE MULTIPLE INPUT CODE
                        $multiple->update(['code' => 'MI' . $multiple->id . $this->randomize()]);
                    }
                }
            }

            // GROUP ANSWER
            if($request->answer_type == 'Group'){
                $data->update([
                    'group_answer_type' => $request->group_answer_type,
                    'transpose_group' => $request->transpose_group,
                    'only_one_choice' => $request->only_one_choice,
                ]);

                // GENERATE GROUP CODE
                $column_code = [];
                $row_code = [];
                for ($i = 0; $i < count(@$request->group_answer_row_text ?? []); $i++) {
                    $row_code[$request->group_answer_row_text[$i]] = 'CR' . $i . $this->randomize();
                }

                for ($i = 0; $i < count(@$request->group_answer_column_text ?? []); $i++) {
                    $column_code[$request->group_answer_column_text[$i]] = 'CC' . $i . $this->randomize();
                }

                // GENERATE GROUP ROW
                $count_ga = 0;
                for ($i = 0; $i < count(@$request->group_answer_row_text ?? []); $i++) { 
                    if($request->group_answer_row_text[$i] != null){
                        $group_row = TestGroupAnswerRow::create([
                            'question_id' => $data->id,
                            'text' => $this->texting($request->group_answer_row_text[$i])
                        ]);

                        // GROUP CODE : ROW
                        $group_row->update(['group_code' => @$row_code[$request->group_answer_row_text[$i]]]);

                        // GENERATE GROUP COLUMN
                        for ($j = 0; $j < count(@$request->group_answer_column_text ?? []); $j++) { 
                            if($request->group_answer_column_text[$j] != null){
                                $group_column = TestGroupAnswerColumn::create([
                                    'group_answer_row_id' => $group_row->id,
                                    'text' => $this->texting($request->group_answer_column_text[$j]),
                                    'right_answer' => @$request->group_answer_column_right_answer[$count_ga],
                                    'score' => @$request->group_answer_column_score[$count_ga],
                                    'disabled' => @$request->group_answer_column_disabled[$count_ga],
                                ]);

                                // UPDATE GROUP COLUMN CODE
                                $group_column->update([
                                    'code' => 'GC' . $group_column->id . $this->randomize(),
                                    'group_code' => @$column_code[$request->group_answer_column_text[$j]]
                                ]);

                                $count_ga += 1;
                            }
                        }

                    }
                }

                
            }
                
        }

        Session::flash('success', 'Question Berhasil Diupdate.');

        return redirect()->route('question.edit', Crypt::encrypt(@$data->id));

    }

    public function delete($id)
    {
        $decId = $this->decrypt($id, 'question.index');

        $data = TestQuestion::whereId($decId)->first();

        if(!$data) return redirect(route('question.index'));

        $data_id = $data->id;

        // SOFT DELETE ALL ANSWER & QUESTION
        $garIds = TestGroupAnswerRow::whereQuestionId($data->id)->pluck('id')->toArray();
        $gacIds = TestGroupAnswerColumn::whereIn('group_answer_row_id', $garIds)->pluck('id')->toArray();
        $mtpIds = TestMultipleInput::whereQuestionId($data->id)->pluck('id')->toArray();

        // ANSWER
        TestUserAnswer::whereQuestionId($data->id)->delete();
        TestUserAnswer::whereIn('group_answer_column_id', $gacIds)->delete();
        TestUserAnswer::whereIn('multiple_input_id', $mtpIds)->delete();

        // QUESTION
        TestMultipleChoice::whereQuestionId($data->id)->delete();
        TestMultipleInput::whereQuestionId($data->id)->delete();
        TestGroupAnswerColumn::whereIn('group_answer_row_id', $garIds)->delete();
        TestGroupAnswerRow::whereQuestionId($data->id)->delete();

        $data->delete();

        return response()->json([
            'success' => true,
            'data' => ['id' => $data_id],
            'status' => 200
        ]);
    }

    public function randomize($n = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
      
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
      
        return strtoupper($randomString);
    }

    public function texting($text = '')
    {
        return preg_replace("/[\n\r]/", "", str_replace("<p>", "", str_replace("</p>", "", $text)));
    }

    public function preview($id)
    {
        $decId = $this->decrypt($id, 'question.index');

        $data = TestQuestion::with('step.module', 'choices', 'multiple_inputs', 'group_answer_rows.group_answer_columns')->whereId($decId)->first();

        // return $data;

        if(!$data) return redirect(route('question.index'));

        return $this->view_page('pages.admin.test.question.preview', ['data' => $data, 'title' => ['title_en' => 'Preview', 'title_in' => 'Preview']]);
    }

}
