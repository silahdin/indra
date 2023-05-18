<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsServices extends Model
{
    protected $table = 'cms_services';
    protected $primaryKey = 'id';
    protected $fillable =   ['icon', 'title_in', 'title_en', 'text_in', 'url', 'text_en', 'rowstate', 'created_at', 'updated_at'];
}
