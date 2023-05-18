<?php

namespace App\Models;

use App\User;
use App\Models\BaseModel as Model;

class TestUserUpload extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
