<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Download extends Model
{
    use SoftDeletes;
    protected $table = 'downloads';
    protected $fillable = [
        'title',
        'description',
         'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->created_ip = Request::ip();
        });
        static::updating(function ($model) {
            $model->modifed_by = auth()->id();
            $model->modifed_ip = Request::ip();
        });
    }
}
