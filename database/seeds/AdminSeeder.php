<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();
        $admin = User::firstOrNew(
        	['username' => 'admin', 'first_name' => 'Admin', 'email' => 'admin@bdovietnam.com', 'password' => bcrypt(ENV('DEFAULT_ADMIN_PASSWORD'))]
        );
        $admin->save();
        $role_admin = Role::findByName(ROLE_ADMIN);
        if(!$admin->hasRole($role_admin)) {
        	$admin->roles()->attach($role_admin);
        }
    }
}
