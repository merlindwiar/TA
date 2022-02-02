<?php

namespace Database\Seeders;

use App\Models\Kekeruhan;
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
        // Kekeruhan::factory(10)->create();
        $this->call([
            // UsersTableSeeder::class,
            // RoleTableSeeder::class,
            // KekeruhanTableSeeder::class,
            // StatusKeruhTableSeeder::class,
            UsersTableSeeder::class,

        ]);
    }
}
