<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsServicesList extends Model
{
    protected $table = 'cms_servicelist';
    protected $primaryKey = 'service_id';
    protected $fillable =   ['name', 'description', 'details', 'sub_service', 'contact_person','contact_person1', 'image', 'created_at', 'updated_at'];

}
