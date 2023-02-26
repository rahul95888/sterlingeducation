<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Commodity extends Model
{
    use SoftDeletes;
    protected $table = 'commodities';
    protected $fillable = [
        'commodity_uid',
        'name',
        'image',
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
            // $model->created_ip = self::getIPAddress();   //$_SERVER['SERVER_ADDR'];
        });
        static::updating(function ($model) {
            $model->modifed_by = auth()->id();
            $model->modifed_ip = Request::ip();
            // $model->modifed_ip = self::getIPAddress();   //$_SERVER['SERVER_ADDR'];
        });
    }

    public function varieties()
    {
        return $this->hasMany(Variety::class, 'commodity_uid', 'commodity_uid');
    }

    protected function getIPAddress()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
