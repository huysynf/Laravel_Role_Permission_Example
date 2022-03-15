<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermisson($permissionName)
    {
        foreach($this->permissions as $permisson)
        {
            if($permisson->name == $permissionName)
            {
                return true;
            }
        }
        return false;
    }
    
}

