<?php

use Illuminate\Database\Seeder;

use App\Repositories\PropertyTypeRepository;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PropertyTypeRepository $propertyTypeRepository)
    {
        $initialValues = config('initial.property_type');


        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $propertyTypeRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $propertyTypeRepository->create(['title'=>$initialValue]);
                }
            }
        }
    }
}
