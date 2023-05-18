<?php

namespace App\Models;

use App\CmsCareer;
use App\Models\BaseModel as Model;
use App\Models\TestModule;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class TestMarking extends Model
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
}
