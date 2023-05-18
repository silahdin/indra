<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsImgTop extends Model{
    protected $table = 'cms_img_top';
    protected $primaryKey = 'id';
    protected $fillable =   ['img_publication', 'img_about', 'img_vision', 'img_team', 'img_career', 'img_corporate', 'img_invest', 'created_at', 'updated_at'];
}
