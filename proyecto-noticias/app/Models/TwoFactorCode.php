<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TwoFactorCode extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','code','created_at'];

        protected $casts = [
        'created_at' => 'datetime',
    ];
}
