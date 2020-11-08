<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\SystemSettingsRepository;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Outputs list view
     * 
     * @param integer $deleted Switches list into a trash bin when it's 1, otherwise it's a normal list of active items.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, SystemSettingsRepository $systemSettingsRepository) 
    {

        // Get all settings:
        $systemSettingMetas = $systemSettingsRepository->all();

        // System settings array:
        $systemSettings = [];

        foreach($systemSettingMetas AS $settingKey=>$settingValue){
            $systemSettings[$settingValue["context"]][] = ["id"=>$settingValue["id"], "key"=>$settingValue["meta_key"], "value"=>$settingValue["meta_value"]];
        }

        return view('admin.settings')->with(['systemSettings'=>$systemSettings, 'module'=>'settings']);

    }

    public function save(Request $request, SystemSettingsRepository $systemSettingsRepository)
    {
        $settingId = $request->id;
        $settingValue = $request->setting_value;

        $systemSettingsRepository->update(["meta_value"=>$settingValue], $settingId);

        return response()->json(['id'=>$settingId]);

    }
    
}   