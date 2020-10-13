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
            foreach($defaultSystemLimits AS $metaContextKey=>$metaContextValue)
            {
                foreach($metaContextValue AS $metaKey=>$metaValue)
                {
                    $metaValueCheck = $systemLimitsRepository->getSetting($metaContextKey, $metaKey);

                    if($metaValueCheck == NULL)
                    {
                        $systemLimitsRepository->create(['context'=>$metaContextKey, 'meta_key'=>$metaKey, 'meta_value'=>$metaValue]);
                    }
                }
            }
        }

    }
}
