<?php

use Illuminate\Database\Seeder;

use App\Repositories\SystemSettingsRepository;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SystemSettingsRepository $systemSettingsRepository)
    {
        
        $defaultSystemSettings = config('settings.system_settings');

        if(sizeof($defaultSystemSettings) > 0)
        {
            foreach($defaultSystemSettings AS $metaContextKey=>$metaContextValue)
            {

                foreach($metaContextValue AS $metaKey=>$metaValue)
                {
                    $metaValueCheck = $systemSettingsRepository->getSetting($metaContextKey, $metaKey);

                    if($metaValueCheck == NULL)
                    {
                        $systemSettingsRepository->create(['context'=>$metaContextKey, 'meta_key'=>$metaKey, 'meta_value'=>$metaValue]);
                    }
                }
            }
        }    

        // Language settings:
        

    }
}
