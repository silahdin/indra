<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\TestQuestion;
use App\Models\TestStep;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestModule extends Model
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

    public function career_modules()
    {
        return $this->hasMany(TestCareerModule::class, 'module_id');
    }

    public function steps()
    {
        return $this->hasMany(TestStep::class, 'module_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(TestQuestion::class, TestStep::class, 'module_id', 'step_id');
    }
}
