<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Bid extends Model
{
    use SoftDeletes;
    protected $table = 'bids';
    protected $fillable = [
        'bid_uid',
        'trade_uid',
        'unique_user_id',
        'user_type',
        'price',
        'status',
        'comment',
        'status_date',
        'status_by',
        'quantity',
        'created_by',
        'deleted_by'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });
    }

    public function trade()
    {
        return $this->hasOne(Trade::class, 'trade_uid', 'trade_uid');
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'unique_user_id', 'unique_user_id');
    }
    public function statusby()
    {
        return $this->hasOne(User::class, 'unique_user_id', 'status_by');
    }
}
