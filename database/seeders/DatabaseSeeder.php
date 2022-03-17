<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin =  Role::updateOrCreate(['name' => 'admin'], [ 'display_name' => 'Người quản trị']);
        $roleUser =  Role::updateOrCreate(['name' => 'user'], [ 'display_name' => 'Khách hàng']);
        $roleManageUser =  Role::updateOrCreate(['name' => 'manage-user'], [ 'display_name' => 'Quản lý người dùng']);


        $permissionCreateUser = Permission:: updateOrCreate(['name' => 'create-user'], [ 'display_name' => 'Tạo người dùng']);
        $permissionUpdateUser = Permission:: updateOrCreate(['name' => 'update-user'], [ 'display_name' => 'Cập nhât người dùng']);
        $permissionShowUser = Permission:: updateOrCreate(['name' => 'show-user'], [ 'display_name' => 'Xem người dùng']);
        $permissionDeleteUser = Permission:: updateOrCreate(['name' => 'delete-user'], [ 'display_name' => 'Xóa người dùng']);


        $roleUser->asignPermissions([$permissionCreateUser->id, $permissionUpdateUser->id, $permissionShowUser->id, $permissionDeleteUser->id]);

        $admin = User::whereEmail('admin@gmail.com')->first();

        if (!$admin)
        {
            $admin = User::factory()->create(['email' => 'admin@gmail.com']);
        }

        $admin->roles()->sync($roleAdmin->id);
    }
}
