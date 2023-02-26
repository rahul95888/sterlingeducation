<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'notification_uid',
        'unique_user_id',
        'message',
        'seen',
        'content',
    ];
    protected $dates = ['created_at', 'updated_at'];


}
