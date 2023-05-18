<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsMessages extends Model{
    protected $table = 'cms_messages';
    protected $primaryKey = 'id';
    protected $fillable =   ['id', 'name', 'email', 'phone', 'message', 'send_to', 'created_at', 'updated_at'];
}
