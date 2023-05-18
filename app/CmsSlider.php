<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSlider extends Model
{
    protected $table = 'cms_slider';
    protected $primaryKey = 'id';
    protected $fillable =   ['img', 'text1_in', 'text1_en', 'text2_top_in', 'text2_top_en', 'text2_down_in', 'text2_down_en', 'text3_in', 'text3_en', 'text_url_in',  'text_url_en', 'url', 'rowstate', 'created_at', 'updated_at'];
}
