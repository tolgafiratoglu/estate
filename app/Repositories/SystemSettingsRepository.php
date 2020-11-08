<?php

    namespace App\Repositories;

    use App\SystemSettings as SystemSettings;
    use Prettus\Repository\Eloquent\BaseRepository;

    use PeterColes\Languages\LanguagesFacade AS Languages;

    class SystemSettingsRepository extends BaseRepository{

        /**
         * Specify Model class name
         *
         * @return string
         */
        function model()
        {
            return "App\\SystemSettings";
        }

        /*
        * Returns enabled languages
        *
        * @param $context context
        *
        * @return array
        */
        public function getEnabledLanguages()
        {

            // Enabled languages:
            $enabledLanguages = [];

            $languages = Languages::lookup();

            if(sizeof($languages) > 0)
            {
                foreach($languages AS $languageKey=>$language)
                {
                    $isEnabled = $this->getSetting("language", "enable_".$languageKey);
                        if($isEnabled == true)
                        {
                            $enabledLanguages[$languageKey] = $language;
                        }
                }
            }

            return $enabledLanguages;

        }

        /*
        * Returns settings by a context.
        *
        * @param $context context
        *
        * @return array
        */
        public function getSettingByContext($context) 
        {

            $settingsObject = SystemSettings::select('id', 'meta_key', 'meta_value')
                                    ->where(
                                        [
                                            "context"=>$context
                                        ]
                                    );

                if($settingsObject->get() != NULL)
                {         
                    $settings = $settingsObject->get()->toArray();
                    return getSettingCollection($settings);
                } else {
                    return NULL;
                }

        }

        /*
        * Returns meta_value for a given meta_key
        *
        * @param $meta_key Meta key
        *
        * @return array
        */
        public function getSetting($context, $metaKey) 
        {

            $settingsObject = SystemSettings::select('id', 'meta_key', 'meta_value')
                                    ->where(
                                        [
                                            "context"=>$context,
                                            "meta_key"=>$metaKey
                                        ]
                                    );

                if($settingsObject->first() != NULL){                        
                    $setting = $settingsObject->first()->toArray();
                    return $setting["meta_value"];
                } else {
                    return NULL;
                }

        }

    }    