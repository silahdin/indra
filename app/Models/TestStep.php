<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestStep extends Model
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

    public function questions()
    {
        return $this->hasMany(TestQuestion::class, 'step_id');
    }
}
