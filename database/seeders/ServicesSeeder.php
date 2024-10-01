<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            array(
                "name" => 'Corte de cabello para hombres',
                "price" => 100,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Corte de cabello para mujeres',
                "price" => 120,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Corte de cabello para niños',
                "price" => 90,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Corte de barba y bigote',
                "price" => 100,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Afeitado clásico con navaja',
                "price" => 100,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Coloración de cabello',
                "price" => 200,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Reflejos y mechas',
                "price" => 300,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Peinados para bodas y eventos especiales',
                "price" => 400,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Tratamientos capilares para cabello dañado o quebradizo',
                "price" => 100,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Masajes capilares para estimular el crecimiento del cabello',
                "price" => 140,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Maquillaje para bodas y eventos especiales',
                "price" => 300,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Manicura y pedicura',
                "price" => 120,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Depilación con cera',
                "price" => 120,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Tratamientos faciales para hombres y mujeres',
                "price" => 130,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Tratamientos de exfoliación corporal',
                "price" => 200,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Masajes relajantes para aliviar el estrés y la tensión muscular',
                "price" => 250,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Extensiones de cabello',
                "price" => 150,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Maquillaje de cejas y pestañas',
                "price" => 100,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Tintura de cejas y pestañas',
                "price" => 150,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
            array(
                "name" => 'Tratamientos de bronceado sin sol',
                "price" => 250,
                "available" => true,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ),
        ];

        DB::table('services')->insert($data);
    }
}
