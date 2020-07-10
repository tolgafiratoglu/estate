<?php

use Illuminate\Database\Seeder;

use App\Repositories\PropertyStatusRepository;

class PropertyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PropertyStatusRepository $propertyStatusRepository)
    {
        $initialValues = config('initial.property_status');

        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $propertyStatusRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $propertyStatusRepository->create(['title'=>$initialValue]);
                }
            }
        }
    }
}
