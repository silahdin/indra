<?php

namespace App\Models;

use App\CmsCareer;
use App\Models\BaseModel as Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestUserCareer extends Model
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

    public function career()
    {
        return $this->belongsTo(CmsCareer::class, 'career_id');
    }
}
