<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'description' => '',
                'created_by' => 1,
                'status' => 1,
                'is_deleted' => 0
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'description' => '',
                'created_by' => 1,
                'status' => 1,
                'is_deleted' => 0
            ],
            [
                'id' => 3,
                'name' => 'User',
                'description' => '',
                'created_by' => 1,
                'status' => 1,
                'is_deleted' => 0
            ]
        ];
        DB::table('role')->insert($data);
    }
}
