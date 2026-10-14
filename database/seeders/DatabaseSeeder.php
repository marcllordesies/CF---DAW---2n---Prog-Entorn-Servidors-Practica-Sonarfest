<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1er: S'executa el d'artistes per omplir la taula d'artistes
            ArtistaSeeder::class,

            // 2on: S'executa el de concerts (que ara ja trobarà els artistes actius creats a dalt)
            ConcertSeeder::class,
        ]);
    }
}
