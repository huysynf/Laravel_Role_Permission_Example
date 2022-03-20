<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(fn ($user) => $user->isSupperAdmin());

        $roles = Role::all();
        foreach ($roles as $role)
        {
            Gate::define(Str::slug($role->name), fn (User $user) =>  $user->hasRole($role->name) );
        }

        $permissions = Permission::all();
        foreach ($permissions as $permission)
        {
            Gate::define(Str::slug($permission->name), fn (User $user) =>  $user->hasPermission($permission->name) );
        }

    }
}
