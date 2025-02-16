<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CryptoCoinsIco extends Model
{
	public $timestamps = false;
    protected $fillable = ['id', 'name', 'alias', 'status', 'featured', 'image', 'website', 'affiliate', 'start_time', 'end_time', 'timezone', 'description'];
}
