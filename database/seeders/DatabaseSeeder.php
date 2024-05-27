<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'cuit' => '20999999991',
            'password' => Hash::make('20999999991'),
        ]);

        DB::table('derivados')->insert([
            'name' => 'Derivado 01',
        ]);
        DB::table('derivados')->insert([
            'name' => 'Derivado 02',
        ]);
        DB::table('derivados')->insert([
            'name' => 'Derivado 03',
        ]);

        DB::table('coeficientes')->insert([
            'name' => 'percepcion',
            'value' => 0.045,
            'description' => 'Percepción'
        ]);

        DB::table('coeficientes')->insert([
            'name' => 'recaudacion',
            'value' => 0.02,
            'description' => 'Recaudación'
        ]);

        DB::table('coeficientes')->insert([
            'name' => 'coef_03',
            'value' => 1.75,
            'description' => 'Coef 03'
        ]);

        $this->call([
            PermissionsDemoSeeder::class,
        ]);
    }
}
