<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessingService extends Model
{
    use SoftDeletes;
    protected $table = 'processing_services';
    protected $fillable = [
        'processing_service_uid',
        'name',
        'commodity_id',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by'
    ];

    public function commodity()
    {
        return $this->hasOne(Commodity::class, 'commodity_uid', 'commodity_id');
    }
}
