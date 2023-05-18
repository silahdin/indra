<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestGroupAnswerRow extends Model
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

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'question_id');
    }

    public function group_answer_columns()
    {
        return $this->hasMany(TestGroupAnswerColumn::class, 'group_answer_row_id');
    }
}
