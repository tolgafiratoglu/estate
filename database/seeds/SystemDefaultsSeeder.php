<?php

use Illuminate\Database\Seeder;

use App\Repositories\SystemDefaultsRepository;

class SystemDefaultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SystemDefaultsRepository $systemDefaultsRepository)
    {
        
        $defaultSystemValues = config('settings.system_defaults');

        if(sizeof($defaultSystemValues) > 0)
        {
            foreach($defaultSystemValues AS $metaContextKey=>$metaContextValue)
            {
                foreach($metaContextValue AS $metaKey=>$metaValue)
                {
                    $metaValueCheck = $systemDefaultsRepository->getSetting($metaContextKey, $metaKey);

                    if($metaValueCheck == NULL)
                    {
                        $systemDefaultsRepository->create(['context'=>$metaContextKey, 'meta_key'=>$metaKey, 'meta_value'=>$metaValue]);
                    }
                }
            }
        }

    }
}
