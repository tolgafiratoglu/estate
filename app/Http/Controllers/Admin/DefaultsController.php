<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\SystemDefaultsRepository;

use App\Http\Controllers\Controller;

class DefaultsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Outputs settings
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, SystemDefaultsRepository $systemDefaultsRepository) 
    {

        // Get all settings:
        $systemSettingMetas = $systemDefaultsRepository->all();

        // System settings array:
        $systemDefaults = [];

        foreach($systemSettingMetas AS $settingKey=>$settingValue){
            $systemDefaults[$settingValue["context"]][] = ["id"=>$settingValue["id"], "key"=>$settingValue["meta_key"], "value"=>$settingValue["meta_value"]];
        }

        return view('admin.defaults')->with(['systemDefaults'=>$systemDefaults, 'module'=>'settings']);

    }

    public function save(Request $request, SystemDefaultsRepository $systemDefaultsRepository)
    {
        $settingId = $request->id;
        $settingValue = $request->setting_value;

        $systemDefaultsRepository->update(["meta_value"=>$settingValue], $settingId);

        return response()->json(['id'=>$settingId]);

    }
    
}   