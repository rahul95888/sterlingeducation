<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unique_user_id',
        'mobile_number',
        'otp',
        'otp_verified_at',
        'registered_at',
        'registered_from',
        'name',
        'date_of_birth',
        'gender',
        'education_uid',
        'company_name',
        'contact_person',
        'number_of_farmers_connected',
        'email',
        'fcm_token',
        'address',
        'country_uid',
        'city_uid',
        'state_uid',
        'district_uid',
        'sub_district_uid',
        'village_uid',
        'pincode_uid',
        'aadhar_number',
        'aadhar_document',
        'aadhar_upload_date',
        'gst_number',
        'gst_document',
        'gst_upload_date',
        'account_number',
        'account_holder_name',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'bank_document',
        'bank_upload_date',
        'address_document_type',
        'address_document_id_number',
        'address_document',
        'address_upload_date',
        'profile_image',
        'kyc_status',
        'user_type',
        'ho_location',
        'job_works',
        'mandi_registration_details',
        'branch_locations',
        'process_method_uid',
        'process_capability_uid',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'otp_verified_at', 'registered_at', 'date_of_birth', 'aadhar_upload_date', 'gst_upload_date', 'bank_upload_date', 'address_upload_date'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'otp_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'otp_verified_at' => 'datetime',
        'registered_at' => 'datetime',
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


    public function education()
    {
        return $this->hasOne(Education::class, 'education_uid', 'education_uid');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'country_uid', 'country_uid');
    }
    public function city()
    {
        return $this->hasOne(City::class, 'city_uid', 'city_uid');
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

    public function pincode()
    {
        return $this->hasOne(Pincode::class, 'pincode_uid', 'pincode_uid');
    }

    public function userCropDetails()
    {
        return $this->hasMany(UserCropDetail::class, 'unique_user_id', 'unique_user_id');
    }

    public function userProcurements()
    {
        return $this->hasMany(UserProcurement::class, 'unique_user_id', 'unique_user_id');
    }

    public function trades()
    {
        return $this->hasMany(Trade::class, 'unique_user_id', 'unique_user_id');
    }
    
    public function bids()
    {
        return $this->hasMany(Bid::class, 'unique_user_id', 'unique_user_id');
    }
}
