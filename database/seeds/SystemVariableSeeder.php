<?php

use Illuminate\Database\Seeder;
use App\Models\SystemVariable;
use Carbon\Carbon;
class SystemVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_variables')->delete();
        SystemVariable::insert([
                ['name' => 'title_subfix', 'value' => '- BDOVietnam', 'input' => 'input', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'default_image', 'value' => '/images/default_banner.jpg', 'input' => 'input', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'favicon', 'value' => '/images/favicon.ico', 'input' => 'input', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'description', 'value' => 'BDOVietnam - Black Desert Online Guides', 'input' => 'textarea', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'author', 'value' => 'Xuan Toc Do', 'input' => 'input', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'keyword', 'value' => 'bdo,bdovietnam,blackdesert', 'input' => 'textarea', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        	]
        );
    }
}
