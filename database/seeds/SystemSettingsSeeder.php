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
                    $metaValueCheck = $systemSettingsRepository->findWhere(["meta_key"=>$metaKey])->count();

                    if($metaValueCheck == 0)
                    {
                        $systemSettingsRepository->create(['context'=>$metaContextKey, 'meta_key'=>$metaKey, 'meta_value'=>$metaValue]);
                    }
                }
            }
        }    

        // Language settings:
        $languages = Languages::lookup();

        if(sizeof($languages) > 0)
        {
            foreach($languages AS $languageKey=>$language)
            {
                $metaValueCheck = $systemSettingsRepository->findWhere(["meta_key"=>$metaKey])->count();

                    if($metaValueCheck == 0)
                    {
                        $metaValue = false;
                        if($languageKey == "en"){
                            $metaValue = true; 
                        }
                        $systemSettingsRepository->create(['context'=>"language", 'meta_key'=>"enable_".$languageKey, 'meta_value'=>$metaValue]);
                    }
            }
        }


    }
}
