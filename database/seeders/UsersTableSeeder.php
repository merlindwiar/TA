<?php

namespace Database\Seeders;
use Carbon\Factory as CarbonFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'=>'1',
                'name' => 'Petugas',
                'level' => 'user',
                'email' => 'petugas@gmail.com',
                'email_verified_at' => new \DateTime,
                'password' => bcrypt('petugas'),
                'remember_token' => 'abcdefgh',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id'=>'2',
                'name' => 'Admin',
                'level' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => new \DateTime,
                'password' => bcrypt('admin'),
                'remember_token' => 'abcdefgh',
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('users')->insert($users);

    }
}
