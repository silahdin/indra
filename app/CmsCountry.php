<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsCountry extends Model
{
    protected $table = 'cms_country';
    protected $primaryKey = 'country_id';
    protected $fillable =   ['directory_id', 'country', 'website'];

}
