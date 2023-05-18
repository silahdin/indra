<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTesti extends Model
{
    protected $table = 'cms_testi';
    protected $primaryKey = 'id';
    protected $fillable =   ['title_in', 'title_en', 'img', 'name', 'text_in', 'title_in', 'text_en', 'position_in', 'position_en', 'rowstate', 'created_at', 'updated_at'];
}


// assets/compro/assets/frontend_assets/images/img_timtrainer/dwi.png