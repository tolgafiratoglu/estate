<?php

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
        $this->call(AuthSeeder::class);
        $this->call(SystemDefaultsSeeder::class);
        $this->call(SystemLimitsSeeder::class);
        $this->call(SystemSettingsSeeder::class);
        $this->call(PropertyInteriorSeeder::class);
    }
}
