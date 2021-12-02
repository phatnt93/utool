<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('data/menu.json');
        if (!file_exists($path)) {
            return true;
        }
        $items = json_decode(file_get_contents($path), true);
        if (!is_array($items)) {
            return true;
        }
        DB::table('menu')->truncate();
        DB::table('menu')->insert($items);
    }
}
