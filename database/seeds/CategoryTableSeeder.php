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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Category::insert([
        		['name' => 'Tin Tức', 'slug' => 'news', 'description' => 'Life Skill', 'banner' => '', 'parent_id' => null, 'created_at' => Carbon::now()],
                ['name' => 'Life Skill', 'slug' => 'life-skill', 'description' => 'Life Skill', 'banner' => '', 'parent_id' => null, 'created_at' => Carbon::now()],
                ['name' => 'Nhân Vật', 'slug' => 'classes', 'description' => 'Life Skill', 'banner' => '', 'parent_id' => null, 'created_at' => Carbon::now()],
                ['name' => 'Game', 'slug' => 'game', 'description' => 'Life Skill', 'banner' => '', 'parent_id' => null, 'created_at' => Carbon::now()],
                // news childs
                ['name' => 'Sự Kiện', 'slug' => 'events', 'description' => 'Sự Kiện ingame', 'banner' => '', 'parent_id' => 1, 'created_at' => Carbon::now()],
                ['name' => 'Cập Nhật', 'slug' => 'updates', 'description' => 'Sự Kiện ingame', 'banner' => '', 'parent_id' => 1, 'created_at' => Carbon::now()],
                // life skill chid
                ['name' => 'Gathering', 'slug' => 'gathering', 'description' => 'Gathering', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Cooking', 'slug' => 'cooking', 'description' => 'Cooking', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Alchemy', 'slug' => 'alchemy', 'description' => 'Alchemy', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Fishing', 'slug' => 'fishing', 'description' => 'Fishing', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Processing', 'slug' => 'processing', 'description' => 'Processing', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Trading', 'slug' => 'trading', 'description' => 'Trading', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Hunting', 'slug' => 'hunting', 'description' => 'Hunting', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Sailing (Bartering)', 'slug' => 'sailing-bartering', 'description' => '', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Training', 'slug' => 'training', 'description' => 'Training', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                ['name' => 'Farming', 'slug' => 'farming', 'description' => 'Farming', 'banner' => '', 'parent_id' => 2, 'created_at' => Carbon::now()],
                // classes chid
                ['name' => 'Archer', 'slug' => 'archer', 'description' => 'Archer', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Berserker', 'slug' => 'berserker', 'description' => 'Berserker', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Dark Knight', 'slug' => 'dark-knight', 'description' => 'Dark Knight', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Guardian', 'slug' => 'guardian', 'description' => 'Guardian', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Kunoichi', 'slug' => 'kunoichi', 'description' => 'Kunoichi', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Lahn', 'slug' => 'lahn', 'description' => 'Lahn', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Maehwa', 'slug' => 'maehwa', 'description' => 'Maehwa', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Musa', 'slug' => 'musa', 'description' => 'Musa', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Mystic', 'slug' => 'mystic', 'description' => 'Mystic', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Ninja', 'slug' => 'ninja', 'description' => 'Ninja', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Ranger', 'slug' => 'Ranger', 'description' => 'Ranger', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Shai', 'slug' => 'shai', 'description' => 'Shai', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Sorceress', 'slug' => 'sorceress', 'description' => 'Sorceress', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Striker', 'slug' => 'striker', 'description' => 'Striker', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Tamer', 'slug' => 'tamer', 'description' => 'Tamer', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Valkyrie', 'slug' => 'valkyrie', 'description' => 'Valkyrie', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Warrior', 'slug' => 'warrior', 'description' => 'Warrior', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Witch', 'slug' => 'witch', 'description' => 'Witch', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                ['name' => 'Wizard', 'slug' => 'wizard', 'description' => 'Wizard', 'banner' => '', 'parent_id' => 3, 'created_at' => Carbon::now()],
                // game children
                ['name' => 'Thủ Thuật', 'slug' => 'tip-trick', 'description' => 'Thủ Thuật', 'banner' => '', 'parent_id' => 4, 'created_at' => Carbon::now()]
        	]
        );
    }
}
