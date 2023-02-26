<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Trade extends Model
{
    use SoftDeletes;
    protected $table = 'trades';
    protected $fillable = [
        'trade_uid',
        'unique_user_id',
        'commodity_uid',
        'variety_uid',
        'description',
        'quantity',
        'price',
        'valid_from',
        'valid_to',
        'address',
        'taluka',
        'state_uid',
        'city_uid',
        'pincode_uid',
        'country_uid',
        'file',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];
    protected $dates = ['created_at', 'updated_at', 'valid_from', 'valid_to'];

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

    public function user()
    {
        return $this->hasOne(User::class, 'unique_user_id', 'unique_user_id');
    }

    public function commodity()
    {
        return $this->hasOne(Commodity::class, 'commodity_uid', 'commodity_uid');
    }

    public function variety()
    {
        return $this->hasOne(Variety::class, 'variety_uid', 'variety_uid');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'state_uid', 'state_uid');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'city_uid', 'city_uid');
    }

    public function pincode()
    {
        return $this->hasOne(Pincode::class, 'pincode_uid', 'pincode_uid');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'country_uid', 'country_uid');
    }
    
}
