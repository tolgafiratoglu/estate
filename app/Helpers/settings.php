<?php

    /*
    * Get settings collection
    * @param $settings Array of settings
    * 
    * @return $settingSet Array of formatted settings
    */
    function getSettingCollection($settings)
    {
        $settingSet = [];
        if(sizeof($settings) > 0){
            foreach($settings AS $key=>$setting)
            {
                $settingSet[$setting["meta_key"]] = $setting["meta_value"];
            }
        }
        return $settingSet;
    }