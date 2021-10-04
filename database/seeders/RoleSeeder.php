<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['libelle' => 'Administrateur']);
        Role::create(['libelle' => 'Conseiller en investissement']);
        Role::create(['libelle' => 'Sous-administrateur']);
    }
}
