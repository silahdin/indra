<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPages extends Model{
    protected $table = 'cms_pages';
    protected $primaryKey = 'id';
    protected $fillable =   ['url', 'position', 'name_in', 'name_en', 'title_in', 'title_en', 'content_in', 'content_en', 'user_id', 'rowstate', 'created_at', 'updated_at'];
}
