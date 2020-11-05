<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('roles')->truncate();

        $roles = ['admin'];

        foreach($roles as $role)
        {
            Role::create(['name' => $role]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Model::reguard();
    }
}
