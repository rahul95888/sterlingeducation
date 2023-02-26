<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class MarketPrice extends Model
{
    use SoftDeletes;
    protected $table = 'market_prices';
    protected $fillable = [
        'market_price_uid',
        'state',
        'district',
        'market',
        'commodity',
        'variety',
        'arrival_date',
        'current_min_price',
        'current_max_price',
        'current_modal_price',
        'previous_min_price',
        'previous_max_price',
        'previous_modal_price'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
