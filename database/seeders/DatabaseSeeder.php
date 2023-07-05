<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RoleSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(ProfilPorteurProjetSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SecteurSeeder::class);
    }
}
