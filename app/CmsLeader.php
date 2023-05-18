<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsLeader extends Model
{
    protected $table = 'cms_leaders';
    protected $primaryKey = 'leader_id';
    protected $fillable =   ['nama', 'jabatan', 'urutan', 'linkedin', 'summary_preview', 'full_summary', 'edu_cert', 'expertise', 'industries', 'pro_societies'];

}
