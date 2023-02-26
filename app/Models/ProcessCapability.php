<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class ProcessCapability extends Model
{
    use SoftDeletes;
    protected $table = 'process_capabilities';
    protected $fillable = [
        'process_capability_uid',
        'process_capability_name',
        'commodity_uid',
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

    public function commodity()
    {
        return $this->hasOne(Commodity::class, 'commodity_uid', 'commodity_uid');
    }

    public static function getAllProcessCapabilityList(){
        $result = ProcessCapability::all(['process_capability_uid','process_capability_name','commodity_uid'])->where('deleted_by','IS NULL',null);
        return $result ? $result->toArray() : [];
    }
    
    public static function getProcessCapabilityList($id){
        $result = ProcessCapability::all(['process_capability_uid','process_capability_name','commodity_uid'])->where('deleted_by','IS NULL',null)->where('process_capability_uid',$id);
        return $result ? $result->toArray() : [];
    }
}
