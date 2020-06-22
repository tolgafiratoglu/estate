<?php

use Illuminate\Database\Seeder;

use App\Repositories\SystemLimitsRepository;

class SystemLimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SystemLimitsRepository $systemLimitsRepository)
    {
        
        $defaultSystemLimits = config('settings.system_limits');

        if(sizeof($defaultSystemLimits) > 0)
        {
            foreach($defaultSystemLimits AS $metaKey=>$metaValue)
            {
                $metaValueCheck = $systemLimitsRepository->getSetting($metaKey);

                if($metaValueCheck == NULL)
                {
                    $systemLimitsRepository->create(['meta_key'=>$metaKey, 'meta_value'=>$metaValue]);
                }
            }
        }

    }
}
