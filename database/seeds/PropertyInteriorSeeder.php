<?php

use Illuminate\Database\Seeder;

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
            foreach($initialValues AS $initialValue)
            {
                $initialValueCheck = $InteriorFeatureRepository->findWhere(['title'=>$initialValue]);

                if($initialValueCheck == NULL)
                {
                    $InteriorFeatureRepository->create(['title'=>$initialValue]);
                }
            }
        }

    }
}
