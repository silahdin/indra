<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =   [
                                'title', 'slug_title', 'images', 'short_desc', 'description', 'st_post', 'created_at', 'updated_at'
                            ];
}
