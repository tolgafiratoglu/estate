<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::factory()->times(100000)->create();
    }
}
