<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		// create permissions
		Permission::create(['name' => 'join festival']);

		// create roles
		$role = Role::create(['name' => 'dj']);

		// assign permissions
		$role->givePermissionTo(['join festival']);
	}
}
