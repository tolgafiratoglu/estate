<?php

use Illuminate\Database\Seeder;

use App\Repositories\ExteriorFeatureRepository;

class PropertyExteriorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ExteriorFeatureRepository $exteriorFeatureRepository)
    {
        
        $initialValues = config('initial.exterior_feature');


        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $exteriorFeatureRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $exteriorFeatureRepository->create(['title'=>$initialValue]);
                }
            }
        }

    }
}
