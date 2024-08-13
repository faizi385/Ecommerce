<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Creating roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        // Creating permissions
        $manageProductsPermission = Permission::create(['name' => 'manage products']);
        $viewProductsPermission = Permission::create(['name' => 'view products']);

        // Assigning permissions to Admin role
        $adminRole->givePermissionTo('manage products');
        $adminRole->givePermissionTo('view products');

        // Assigning permissions to User role
        $userRole->givePermissionTo('view products');

        // Create a user and assign the Admin role
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password')
            ]
        );
        $user->assignRole($adminRole);
    }
}

