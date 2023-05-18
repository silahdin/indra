<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $table = 'car_image';
    protected $primaryKey = 'car_image_id';
    protected $fillable =   ['car_id', 'name', 'images', 'created_at', 'updated_at'];
}
