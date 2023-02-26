<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class SubDistrict extends Model
{
    use SoftDeletes;
    protected $table = 'sub_districts';
    protected $fillable = [
        'sub_district_uid',
        'sub_district_name',
        'district_uid',
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

    public function district()
    {
        return $this->hasOne(District::class, 'district_uid', 'district_uid');
    }

    public function villages(){
        return $this->hasMany(Village::class,'village_uid','village_uid');
    }
}
