<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FcasListings extends Model
{
    public $timestamps = false;

    public function cryptoMarkets()
    {
        return $this->hasOne('App\CryptoMarkets', 'symbol', 'symbol');
    }
}
