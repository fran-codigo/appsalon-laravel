<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "role" => 'Client',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "role" => 'Admin',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ];

        DB::table('role_user')->insert($data);
    }
}
