<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserProcurement extends Model
{
    use SoftDeletes;

    protected $table = 'user_procurements';
    protected $fillable = [
        'unique_user_id',
        'user_type',
        'user_procurement_uid',
        'warehouse_address',
        'warehouse_capacity',
        'warehouse_type_uid',
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

    protected $dates = ['created_at', 'updated_at'];

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

    public function user()
    {
        return $this->hasOne(User::class, 'unique_user_id', 'unique_user_id');
    }

    public function warehouseType()
    {
        return $this->hasOne(WarehouseType::class, 'warehouse_type_uid', 'warehouse_type_uid');
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
