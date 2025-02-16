<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;
class Exchanges extends Model
{
    //

    public function getLogoAttribute($logo)
    {
    	if(file_exists('public/storage/' . $logo)) {
            return URL::asset('public/storage') . '/' . $logo;
        } else {
            return 'https://www.cryptocompare.com' . $logo;
        }
    }

}
