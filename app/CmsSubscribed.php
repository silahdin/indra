<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSubscribed extends Model{
    protected $table = 'cm_subscribed';
    protected $primaryKey = 'id';
    protected $fillable =   ['email', 'rowstate', 'created_at', 'updated_at'];
}
