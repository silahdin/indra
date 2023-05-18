<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyBidding extends Model
{
    protected $table = 'reply_bidding';
    protected $primaryKey = 'reply_id';
    protected $fillable =   [
                                'session_id', 'user_id', 'file', 'reply', 'created_at', 'updated_at'
                            ];
}
