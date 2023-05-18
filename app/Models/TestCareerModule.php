<?php

namespace App\Models;

use App\CmsCareer;
use App\Models\BaseModel as Model;
use App\Models\TestModule;
use App\Models\TestUserOngoing;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestCareerModule extends Model
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

    public function module()
    {
        return $this->belongsTo(TestModule::class, 'module_id');
    }

    public function career()
    {
        return $this->belongsTo(CmsCareer::class, 'career_id');
    }

    public function user_ongoings()
    {
        return $this->hasMany(TestUserOngoing::class, 'module_career_id');
    }
}
