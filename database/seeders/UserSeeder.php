<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'nom' => $faker->firstName(),
            'prenom' => $faker->lastName(),
            'email' => 'admin@test.com',
            'telephone' => $faker->phoneNumber(),
            'role' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('admin')
        ]);
        User::create([
            'nom' => $faker->firstName(),
            'prenom' => $faker->lastName(),
            'email' => 'conseille@test.com',
            'telephone' => $faker->phoneNumber(),
            'role' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('conseille')
        ]);
        User::create([
            'nom' => $faker->firstName(),
            'prenom' => $faker->lastName(),
            'email' => 'porteur@test.com',
            'telephone' => $faker->phoneNumber(),
            'role' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make('porteur')
        ]);
        User::create([
            'nom' => $faker->firstName(),
            'prenom' => $faker->lastName(),
            'email' => 'investisseur@test.com',
            'telephone' => $faker->phoneNumber(),
            'role' => 4,
            'email_verified_at' => now(),
            'password' => Hash::make('investisseur')
        ]);
    }
}
