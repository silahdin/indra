<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel as Model;

class CmsCareer extends Model
{
    protected $table = 'cms_career';
    protected $primaryKey = 'id';
    protected $fillable =   ['url', 'img', 'position_en','position_en', 'jobdesk_ch', 'jobdesk_en', 'requirement_ch', 'requirement_en', 'location_en','location_ch', 'date_start', 'date_end', 'rowstate', 'created_at', 'updated_at'];
}
