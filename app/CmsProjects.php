<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsProjects extends Model
{
    protected $table = 'cms_projects';
    protected $primaryKey = 'id';
    protected $fillable =   ['img', 'text_in', 'text_en', 'url', 'rowstate', 'created_at', 'updated_at'];
}
