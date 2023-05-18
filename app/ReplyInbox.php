<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyInbox extends Model
{
    protected $table = 'reply_inbox';
    protected $primaryKey = 'reply_id';
    protected $fillable =   [
                                'inbox_id', 'user_id', 'file', 'reply', 'created_at', 'updated_at'
                            ];
}
