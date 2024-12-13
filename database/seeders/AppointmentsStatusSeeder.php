<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            array(
                "name" => 'Activo',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Finalizado',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Cancelado',
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            )
        ];
        DB::table('appointments_status')->insert($data);
    }
}
