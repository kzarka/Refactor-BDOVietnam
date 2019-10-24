<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->truncate();
    	DB::table('role_user')->truncate();
        Role::insert([
        		['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Admin - Highest rank', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        		['name' => 'mod', 'display_name' => 'Moderator', 'description' => 'Mod - Under the sky', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        		['name' => 'ctv', 'display_name' => 'Cộng Tác Viên', 'description' => 'CTV - Under the sky', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        	]
        );
    }
}
