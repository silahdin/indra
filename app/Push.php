<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $table = 'push';
    protected $primaryKey = 'push_id';
    protected $fillable =   [
                                'car_id', 'user_id', 'to_date', 'possition', 'st_push', 'created_at', 'updated_at'
                            ];
}
