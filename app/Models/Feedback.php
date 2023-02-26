<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Feedback extends Model
{
    use SoftDeletes;

    protected $table = 'feedbacks';

    protected $fillable = [
        'feedback_uid',
        'image',
        'rate',
        'message',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = $model->unique_user_id;
            $model->created_ip = Request::ip();
        });

        static::updating(function ($model) {
            $model->modifed_by = $model->unique_user_id;
            $model->modifed_ip = Request::ip();
        });
    }
}
