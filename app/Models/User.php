<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password',];


    protected $hidden = ['password', 'remember_token',];


    protected $casts = ['email_verified_at' => 'datetime',];


    public function getRouteKeyName()
    {
        return 'name';
    }

    public function threads(){
        return $this->hasMany(Thread::class)->latest();
    }

    public function activity(){
        return $this->hasMany(Activity::class);
    }
}
