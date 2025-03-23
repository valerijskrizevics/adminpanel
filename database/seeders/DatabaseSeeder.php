<?php

namespace Database\Seeders;

use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(RolesAndPermissionsSeeder $spatieSeeder): void
    {
        $spatieSeeder->run();
    }
}
