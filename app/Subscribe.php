<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';
    protected $primaryKey = 'subscribe_id';
    protected $fillable =   [
                                'email', 'st_subscribe', 'created_at', 'updated_at'
                            ];
    //public $timestamps = false;
}
