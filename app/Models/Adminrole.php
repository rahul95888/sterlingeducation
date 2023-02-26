<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminrole extends Model
{
    use HasFactory;
    protected $table = 'adminroles';
    protected $fillable = [
        'role_uid',
        'name',
        'permissions',
        'created_by',
        'deleted_by'
    ];
    function role(){

        return $this->belongsTo('App\Models\Admin');

    }
}
