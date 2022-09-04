<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PushNotification extends Model
{
    // Insert the current user data while saving date
    use HasUser;
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
