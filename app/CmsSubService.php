<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSubService extends Model
{
    protected $table = 'cms_sub_services';
    protected $primaryKey = 'sub_services_id';
    protected $fillable =   ['service_id', 'name', 'description', 'situation_part', 'help_part', 'contact_one', 'contact_two', 'partner', 'created_at', 'updated_at'];

}
