<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Fakultas::create([
            'nama' => 'Sains dan Teknologi'
        ]);

        Jurusan::create([
            'nama' => 'Teknik Informatika',
            'fakultas_id' => 1
        ]);

        Jurusan::create([
            'nama' => 'Matermatika',
            'fakultas_id' => 1
        ]);

        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i < 10; $i++) { 
            Mahasiswa::create([
                'nama' => $faker->name('male'),
                'nim' => $faker->numerify('########'),
                'jk' => 'L',
                'jurusan_id' => $faker->numberBetween(1, 2),
                'alamat' => $faker->address(),
                'email' => $faker->email()
            ]);
        }
    }
}
