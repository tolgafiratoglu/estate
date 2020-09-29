<?php

namespace Database\Factories;

use App\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->name . rand(0, 100),
            'slug'=>$this->faker->name . rand(0, 100),
            'description'=>$this->faker->paragraph,
            'location'=>1,
            'approval_status'=>'approved',
            'property_status'=>rand(1,2),
            'property_type'=>rand(1,2),
            'featured_image'=>rand(1,9),
            'price'=>rand(100, 300),
            'area'=>rand(100, 200),
            'year_built'=>date("Y"),
            'is_deleted'=>false,
            'is_drafted'=>false,
            'is_custom_info'=>false,
            'has_park_area'=>false,
            'has_garden'=>false,
            'which_floor'=>rand(0,10),
            'number_of_floors'=>rand(2, 10),
            'number_of_rooms'=>rand(2, 10),
            'number_of_bathrooms'=>rand(2, 10),
            'created_by'=>1
        ];
    }
}
