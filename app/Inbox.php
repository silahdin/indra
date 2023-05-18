<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';
    protected $primaryKey = 'inbox_id';
    protected $fillable =   ['f_user_id', 't_user_id', 'nama', 'email', 'nomer_hp', 'type', 'star', 'subject', 'slug_subject', 'file', 'content', 'st_inbox', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
