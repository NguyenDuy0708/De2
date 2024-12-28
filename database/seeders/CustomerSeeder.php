<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];

        for ($i = 0; $i < 50; $i++) {
            $data[] =[
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'status' => $faker->randomElement(['active', 'inactive', 'banned']),
                'account_type' => $faker->randomElement(['basic', 'premium', 'enterprise']),
                'last_login' => $faker->optional()->dateTimeThisYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($data);
    }
}
