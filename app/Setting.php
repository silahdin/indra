<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    //protected $primaryKey = 'id_field';
    protected $fillable =   [
                                'title', 'keywords', 'description', 'aboutus', 'no_tlp', 'alamat', 'email', 'desc_footer'
                            ];
}
