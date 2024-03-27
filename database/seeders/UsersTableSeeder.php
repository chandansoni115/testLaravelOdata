<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'region' => $faker->randomElement(['India', 'Canada', 'United States', 'United Kingdom']),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
        //
    }
}
