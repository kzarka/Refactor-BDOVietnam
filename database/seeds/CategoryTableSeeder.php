<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('games')->delete();
        Category::insert([
        		['name' => 'Life Skill', 'slug' => 'life-skill', 'description' => 'Life Skill', 'banner' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        	]
        );
    }
}
