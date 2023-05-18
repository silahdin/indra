<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMobil extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $fillable =   [
                                'dealer_id', 'name', 'slug', 'merk', 'type', 'tahun', 'warna', 'transmisi', 'kilometer', 'pajak', 'bpkb', 'image', 'price', 'description', 'hits', 'st_car', 'created_at', 'updated_at'
                            ];
    //public $timestamps = false;

    /*protected $casts = [
        'attendees' => 'array',
    ];*/
}
