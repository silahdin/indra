<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsVision extends Model{
    protected $table = 'cms_vision';
    protected $primaryKey = 'id';
    protected $fillable =   ['vision_in', 'vision_en', 'mission_in', 'mission_en', 'created_at', 'updated_at'];
}
