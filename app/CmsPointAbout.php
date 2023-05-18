<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPointAbout extends Model{
    protected $table = 'cms_point_about';
    protected $primaryKey = 'id';
    protected $fillable =   ['title_in', 'title_en', 'content_in', 'content_en', 'rowstate', 'created_at', 'updated_at'];
}
