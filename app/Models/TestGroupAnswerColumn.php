<?php

namespace App\Models;

use App\Models\TestGroupAnswerRow;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestGroupAnswerColumn extends Model
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

    public function group_answer_row()
    {
        return $this->belongsTo(TestGroupAnswerRow::class, 'group_answer_row_id');
    }
}
