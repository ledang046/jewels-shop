<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =
    [
        'name','code','time','number','condition'
    ];
    protected $table = 'coupons';
}
