<?php

namespace App\Models;

use App\Casts\Users\Name;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

     public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roleName)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $roleName)
            {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permissionName)
    {
        foreach($this->roles as $role)
        {
            if($role->hasPermision($permissionName))
            {
                return true;
            }
        }
        return false;
    }
}

$user = USer::coten("Load");

$user->hasRole("admin");

$user->hasPermission('create-user');


/// middle waret 


view - route -  middleware - controller 

route ->cos quiyen vao hay khong 



Auth::user() // tra ve doi tuwong user
auth()->user() // tr va tuong tu


// check.role check.perrrmison