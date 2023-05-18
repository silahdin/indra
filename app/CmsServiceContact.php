<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsServiceContact extends Model
{
    protected $table = 'cms_service_contact';
    protected $primaryKey = 'contact_id';
    protected $fillable =   ['name', 'title', 'email', 'image', 'phone', 'linkedin'];

}
