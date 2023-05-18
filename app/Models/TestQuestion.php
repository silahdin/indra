<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestQuestion extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    public function step()
    {
        return $this->belongsTo(TestStep::class, 'step_id');
    }

    public function choices()
    {
        return $this->hasMany(TestMultipleChoice::class, 'question_id');
    }

    public function multiple_inputs()
    {
        return $this->hasMany(TestMultipleInput::class, 'question_id');
    }

    public function group_answer_rows()
    {
        return $this->hasMany(TestGroupAnswerRow::class, 'question_id');
    }
}
