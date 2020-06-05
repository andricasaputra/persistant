<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'e_password', 'nip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'e_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard_name = 'api';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function failedJob()
    {
        return $this->hasMany(UserFailedJobs::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('valid_until');
    }

    public function scopeWithNoAdmin($query)
    {
        $query->where('id', '!=', 1);
    }
}
