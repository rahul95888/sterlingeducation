<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackholderProcurementCenterInfo extends Model
{
    protected $table = 'stackholder_procurement_center_list';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'stackholder_id',
        'stackholder_type',
        'warehouse_address',
        'warehouse_capacity',
        'capacity_unit',
        'warehouse_type',
        'state_id',
        'district_id',
        'sub_district_id',
        'village_id',
    ];

    public function stackholder()
    {
        $stackholder_type = $this->stackholder_type;

        if ($stackholder_type == 'farmers') {
            return $this->belongsTo(Farmer::class, 'stackholder_id');
        } elseif ($stackholder_type == 'fpos') {
            return $this->belongsTo(Fpo::class, 'stackholder_id');
        } elseif ($stackholder_type == 'processors') {
            return $this->belongsTo(Processor::class, 'stackholder_id');
        } elseif ($stackholder_type == 'traders') {
            return $this->belongsTo(Trader::class, 'stackholder_id');
        } else {
            return null;
        }
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function subdistrict()
    {
        return $this->hasOne(SubDistrict::class, 'id', 'sub_district_id');
    }

    public function village()
    {
        return $this->hasOne(Village::class, 'id', 'village_id');
    }
}
