<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role',);
    }

    public function asignPermissions($permissionIds)
    {
        return $this->permissions()->sync($permissionIds);
    }

    public function hasPermission($permissionName):bool
    {
        return $this->permissions->contains('name', $permissionName);
    }
}
