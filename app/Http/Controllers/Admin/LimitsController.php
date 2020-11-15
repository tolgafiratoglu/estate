<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\SystemLimitsRepository;

use App\Http\Controllers\Controller;

class LimitsController extends Controller
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
    public function index(Request $request, SystemLimitsRepository $systemLimitsRepository) 
    {

        // Get all settings:
        $systemLimitMetas = $systemLimitsRepository->all();

        // System settings array:
        $systemLimits = [];

        foreach($systemLimitMetas AS $settingKey=>$settingValue){
            $systemLimits[$settingValue["context"]][] = ["id"=>$settingValue["id"], "key"=>$settingValue["meta_key"], "value"=>$settingValue["meta_value"]];
        }

        // Default System Limits
        $defaultSystemLimits = config('settings.system_limits');

        return view('admin.limits')->with(['systemLimits'=>$systemLimits, 'defaultSystemLimits' => $defaultSystemLimits, 'module'=>'settings']);

    }

    public function save(Request $request, SystemLimitsRepository $systemLimitsRepository)
    {
        $settingId = $request->id;
        $limit = $request->limit;

        $systemLimitsRepository->update(["meta_value"=>$limit], $settingId);

        return response()->json(['id'=>$settingId]);

    }
    
}   