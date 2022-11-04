<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function userimages() {
        return $this->hasOne('App\Models\UserImage','user_id','id');
    }

    public function profile() {
        return $this->hasOne('App\Models\UserProfile','user_id','id');
    }

    public function messages() {
        return $this->belongsToMany('App\Models\Message');
    }

    public function push_notifcations() {
        return $this->belongsToMany('App\Models\PushNotification');
    }
}
