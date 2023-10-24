<?php

namespace Database\Seeders;

use Database\Factories;
use App\Models\foto_profil;
use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //foto_profil::factory(3)->create();
        $this->call([
            pesan::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
