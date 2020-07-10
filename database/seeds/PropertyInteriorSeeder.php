<?php

use Illuminate\Database\Seeder;

use App\Repositories\InteriorFeatureRepository;

class PropertyInteriorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(InteriorFeatureRepository $InteriorFeatureRepository)
    {
        
        $initialValues = config('initial.interior_feature');


        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $InteriorFeatureRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $InteriorFeatureRepository->create(['title'=>$initialValue]);
                }
            }
        }

    }
}
