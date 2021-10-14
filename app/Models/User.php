<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Constant;
use Spatie\Permission\Traits\HasRoles;
use Spatie\ModelStatus\HasStatuses;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasApiTokens, Notifiable, HasRoles, HasStatuses;

    protected $hidden = [
        'pin', 'biometric', 'updated_at', 'email_verified_at', 'password', 'remember_token', 'device_token', 'is_admin'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime:'.Constant::DATE_FORMAT,
        'created_at' => 'datetime:'.Constant::DATE_FORMAT,
        'updated_at' => 'datetime:'.Constant::DATE_FORMAT,
    ];

    protected $guarded = [];

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'gender',
        'country',
        'dob',
        'address',
        'street',
        'city',
        'zipcode',
        'about_me',
        'is_active',
        'pin',
        'biometric',
        '2fa',
        '2fa_code',
        'refresh_token',
    ];

    protected $with = [

    ];

    public function getStatusAttribute()
    {
        return $this->status()->name;
    }

    public function getAvatarAttribute($value)
    {
        $path = avatarsPath();
        return ($value) ? file_exists($path.$value) ? $path.$value: $path.'no-image.png' : $path.'no-image.png';
    }

    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Route notifications for the FCM channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->device_token;
    }

}
