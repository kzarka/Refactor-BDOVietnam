<?php

use Illuminate\Database\Seeder;
use App\Models\Game;
use Carbon\Carbon;
class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_game')->delete();
        DB::table('games')->delete();
        Game::insert([
        		['name' => 'Black Desert', 'slug' => 'black-desert', 'description' => 'BDO', 'thumbnail' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        	]
        );
    }
}
