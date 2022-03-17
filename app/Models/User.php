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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles():\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param $roleName
     * @return mixed
     */
    public function hasRole($roleName):bool
    {
        return $this->roles->contains('name', $roleName);
    }

    /**
     * @param $permissionName
     * @return bool
     */
    public function hasPermission($permissionName):bool
    {
        $roles = $this->roles;
        foreach ($roles as $role)
        {
            if ($role->hasPermission($permissionName)) return true;
        }

        return  false;
    }

    /**
     * @param $roleNames
     * @return mixed
     */

    public function hasRoles($roleNames):bool
    {
        return $this->roles->contains(fn($role) => in_array($role->name, $roleNames));
    }
}
