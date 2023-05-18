<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsGlobalList extends Model
{
    protected $table = 'cms_global_list';
    protected $primaryKey = 'global_list_id';
    protected $fillable =   ['directory_id', 'country_id', 'category', 'website', 'content', 'st_list'];
}
