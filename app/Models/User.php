<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use App\Models\Mutators\UserMutators;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Accessors\UserAccessors;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens, UserMutators, UserAccessors;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
