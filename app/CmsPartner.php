<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPartner extends Model
{
    protected $table = 'cms_partner';
    protected $primaryKey = 'id';
    protected $fillable =   ['logo', 'url', 'rowstate', 'created_at', 'updated_at'];
}
