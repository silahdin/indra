<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsGlobalOffice extends Model
{
    protected $table = 'cms_global_directory';
    protected $primaryKey = 'global_directory_id';
    protected $fillable =   ['directory_id', 'country_id', 'website', 'cr_name1', 'cr_title1', 'cr_email1', 'cr_phone1', 'cr_mobile1',  'cr_name2', 'cr_title2', 'cr_email2', 'cr_phone2', 'cr_mobile2', 'lo_name1', 'lo_title1', 'lo_email1', 'lo_phone1', 'lo_mobile1', 'lo_name2', 'lo_title2', 'lo_email2', 'lo_phone2', 'lo_mobile2', 'created_at', 'updated_at'];

}
