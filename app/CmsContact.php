<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsContact extends Model
{
    protected $table = 'cms_contact';
    protected $primaryKey = 'id';
    protected $fillable =   ['title_in', 'title_en', 'text_in', 'text_en', 'address_in', 'address_en', 'address_map', 'telp', 'email', 'created_at', 'updated_at'];
}
