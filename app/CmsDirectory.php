<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsDirectory extends Model
{
    protected $table = 'cms_directory';
    protected $primaryKey = 'directory_id';
    protected $fillable =   ['directory'];

}
