<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsProduct extends Model
{
    protected $table = 'cms_product';
    protected $primaryKey = 'id';
    protected $fillable =   ['img_icon', 'title_in', 'title_en', 'description_in', 'description_en', 'content_in', 'content_en', 'created_at', 'updated_at'];
}
