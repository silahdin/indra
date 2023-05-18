<?php

namespace App\Models;

use App\CmsCareer;
use App\Models\BaseModel as Model;
use App\Models\TestModule;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class TestResult extends Model
{
	use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['total_score', 'total_question'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    public function module()
    {
        return $this->belongsTo(TestModule::class, 'module_id');
    }

    public function career()
    {
        return $this->belongsTo(CmsCareer::class, 'career_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTotalScoreAttribute()
    {
        return $this->module->questions->where('right_answer', '!=', null)->sum('score');
    }

    public function getTotalQuestionAttribute()
    {
        return $this->module->questions->where('right_answer', '!=', null)->count();
    }

}
