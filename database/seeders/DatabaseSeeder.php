<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'product-list',  
        'product-create',  
        'product-edit',  
        'product-delete',  
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'Administrator']);
        $managerRole = Role::create(['name' => 'Manager']);

        foreach (Permission::all() as $permission) {
            $permission->assignRole($adminRole);
        }

        $managerRole->givePermissionTo(['product-list', 'product-create']);

        $adminUser = User::where('email', '=', 'usera@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('Administrator');
        }

        $managerUser = User::where('email', '=', 'userb@example.com')->first();
        if ($managerUser) {
            $managerUser->assignRole('Manager');
        }
    }
}
