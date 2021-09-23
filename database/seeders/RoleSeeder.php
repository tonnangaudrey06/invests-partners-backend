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
        Role::create(['libelle' => 'Conseillé d’investissement']);
        Role::create(['libelle' => 'Porteur projet']);
        Role::create(['libelle' => 'Investisseur']);
    }
}
