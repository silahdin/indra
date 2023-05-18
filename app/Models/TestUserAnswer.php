<?php

namespace App\Models;

use App\Models\TestGroupAnswerRow;
use App\Models\TestSectionQuestion;
use App\User;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestUserAnswer extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(TestSectionQuestion::class, 'question_id');
    }

    public function group_answer_column()
    {
        return $this->belongsTo(TestGroupAnswerColumn::class, 'group_answer_column_id');
    }
}
