<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    protected $table = 'bidding';
    protected $primaryKey = 'bidding_id';
    protected $fillable =   [
                                'session_id', 'f_user_id', 't_user_id', 'car_id', 'bidding', 'description', 'read', 'created_at', 'updated_at'
                            ];
}
