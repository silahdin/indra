<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsServicePartner extends Model
{
    protected $table = 'cms_services_partner';
    protected $primaryKey = 'partner_id';
    protected $fillable =   ['name', 'sub_service_id', 'image', 'description', 'created_at', 'updated_at'];

}
