<?php

namespace TCG\Voyager\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Contracts\User as UserContract;
use TCG\Voyager\Traits\HasRelationships;
use TCG\Voyager\Traits\VoyagerUser;
use URL;
class User extends Authenticatable implements UserContract
{
    use VoyagerUser,
        HasRelationships;

    protected $guarded = [];

    public function getAvatarAttribute($value)
    {
        if(file_exists("public/images/users/" . $value)) {
            return URL::asset("public/images/users") . '/' . $value;
        } else if(file_exists('public/storage/' . $value)) {
            return URL::asset('public/storage') . '/' . $value;
        } else {
            return URL::asset('public/images/default-user.jpg');
        }
        // if (is_null($value)) {
        //     return config('voyager.user.default_avatar', 'users/default.png');
        // }

        // return $value;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
