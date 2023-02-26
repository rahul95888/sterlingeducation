<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class State extends Model
{
    use SoftDeletes;
    protected $table = 'states';
    protected $fillable = [
        'state_uid',
        'state_name',
        'state_code',
        'country_uid',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by'
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

    public function country()
    {
        return $this->hasOne(Country::class, 'country_uid', 'country_uid');
    }

    public function district(){
        return $this->hasMany(District::class,'state_uid','state_uid');
    }
}
