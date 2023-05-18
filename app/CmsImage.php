<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsImage extends Model
{
    protected $table = 'cms_image';
    protected $primaryKey = 'id';
    protected $fillable =   ['img', 'created_at', 'updated_at'];
}
