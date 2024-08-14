<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Person;
use App\Models\User;
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
        $cuit = "20319602020";
        $person = Person::create([
            'cuit' => $cuit,
            'name' => 'Usuario de Prueba',
            'direccion' => 'Algun lugar 1234',
        ]);

        User::create([
            'person_id' => $person->id,
            'cuit' => $cuit,
            'password' => '$2y$10$tW7KgFlt5d4o9JIabl2YJO8Tlj7IrU7kitUhm94z4cjylET9GsLum',
        ]);

        $this->call([
            PermissionsDemoSeeder::class,
        ]);
    }
}
