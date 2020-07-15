<?php

use Illuminate\Database\Seeder;

use App\Repositories\CoolingRepository;

class CoolingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CoolingRepository $coolingRepository)
    {
        $initialValues = config('initial.cooling');

        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $coolingRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $coolingRepository->create(['title'=>$initialValue]);
                }
            }
        }
    }
}
