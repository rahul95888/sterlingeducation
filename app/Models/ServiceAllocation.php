<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class ServiceAllocation extends Model
{
    use SoftDeletes;
    protected $table = 'service_allocations';
    protected $fillable = [
        'service_allocation_uid',
        'service_uid',
        'state_uid',
        'district_uid',
        'sub_district_uid',
        'village_uid',
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

    public function service()
    {
        return $this->hasOne(Service::class, 'service_uid', 'service_uid');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'state_uid', 'state_uid');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'district_uid', 'district_uid');
    }

    public function subDistrict()
    {
        return $this->hasOne(SubDistrict::class, 'sub_district_uid', 'sub_district_uid');
    }

    public function village()
    {
        return $this->hasOne(Village::class, 'village_uid', 'village_uid');
    }
}
