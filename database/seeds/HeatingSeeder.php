<?php

use Illuminate\Database\Seeder;

use App\Repositories\HeatingRepository;

class HeatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(HeatingRepository $heatingRepository)
    {
        $initialValues = config('initial.heating');

        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $heatingRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $heatingRepository->create(['title'=>$initialValue]);
                }
            }
        }
    }
}
