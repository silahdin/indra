<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsBranch extends Model
{
    protected $table = 'cms_branch';
    protected $primaryKey = 'id_branch';
    protected $fillable =   ['type', 'latitude', 'longitude', 'selectable', 'zoomLevel', 'color', 'title', 'description', 'address_one', 'address_two', 'url', 'created_at', 'updated_at'];
}
