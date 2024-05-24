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

        DB::table('coeficientes')->insert([
            'name' => 'coef_01',
            'value' => 1.37,
            'description' => 'Coef 01'
        ]);

        DB::table('coeficientes')->insert([
            'name' => 'coef_02',
            'value' => 1.04,
            'description' => 'Coef 02'
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
