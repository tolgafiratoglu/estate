<?php

use Illuminate\Database\Seeder;

use App\Repositories\ViewRepository;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ViewRepository $viewRepository)
    {
        $initialValues = config('initial.view');

        if(sizeof($initialValues) > 0)
        {
            foreach($initialValues AS $key=>$initialValue)
            {
                $initialValueCheck = $viewRepository->findWhere(['title'=>$initialValue])->toArray();

                if(sizeof($initialValueCheck) == 0)
                {
                    $viewRepository->create(['title'=>$initialValue]);
                }
            }
        }
    }
}
