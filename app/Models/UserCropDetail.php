<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserCropDetail extends Model
{
    use SoftDeletes;

    protected $table = 'user_crop_details';
    protected $fillable = [
        'unique_user_id',
        'user_crop_detail_uid',
        'commodity_uid',
        'variety_uid',
        'acreage',
        'primary_processing_method',
        'sowling_date',
        'farm_location',
        'form_factor',
        'tonnage_daily',
        'tonnage_monthly',
        'tonnage_yearly',
        'state_uid',
        'district_uid',
        'sub_district_uid',
        'village_uid',
        'ho_location',
        'branch_locations',
        'process_method_uid',
        'mandi_registration_details',
        'process_capability_uid',
        'daily_plant_capabality',
        'weekly_plant_capabality',
        'monthly_plant_capabality',
        'number_of_farmers_connected',
        'job_works',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'sowling_date'];

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


    public function commodity()
    {
        return $this->hasOne(Commodity::class, 'commodity_uid', 'commodity_uid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'unique_user_id', 'unique_user_id');
    }
    public function variety()
    {
        return $this->hasOne(Variety::class, 'variety_uid', 'variety_uid');
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

    public function farm_factor()
    {
        return $this->hasOne(FarmFactor::class, 'farm_factor_uid', 'form_factor');
    }
    public function process_method()
    {
        return $this->hasOne(ProcessMethod::class, 'process_method_uid', 'process_method_uid');
    }
    public function process_capability()
    {
        return $this->hasOne(ProcessCapability::class, 'process_capability_uid', 'process_capability_uid');
    }
    public static function getMandiRegistrationDetail(){
        // var_dump(Auth::user()->unique_user_id);die;exit;
        $result = UserCropDetail::
	all(['mandi_registration_details']);
//	->where('mandi_registration_details','!=',null)
 //       where('unique_id','=',"4be18d0f8qHF");
       // ->toArray();
        var_dump($result);die;exit;
        return $result;
        //4be18d0f8qHF
    }
}
