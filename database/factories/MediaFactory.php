<?php

namespace Database\Factories;

use App\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name.'.jpg',
            'folder'=>'storage/2020/9/',
            'user_id'=>1,
            'is_deleted'=>false
        ];
    }
}
