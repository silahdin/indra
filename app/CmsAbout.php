<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsAbout extends Model{
    protected $table = 'cms_about';
    protected $primaryKey = 'id';
    protected $fillable =   ['title_in', 'title_en', 'text_in', 'text_en', 'content_in', 'content_en', 'title_service_in', 'title_service_en', 'content_service_in', 'content_service_en', 'rowstate', 'created_at', 'updated_at'];
}
