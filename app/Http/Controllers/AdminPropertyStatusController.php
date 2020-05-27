<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PropertyStatusRepository;

class AdminPropertyStatusController extends Controller
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
     * Lists admin propert status:
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, PropertyStatusRepository $propertyStatusRepository)
    {

        $offset   = $request->offset ? $request->offset : NULL;
        $limit    = $request->limit ? $request->limit: NULL;
        $deleted  = $request->deleted ? $request->deleted : false;

        $propertyStatusList = $propertyStatusRepository->getStatusList($deleted, 0, 10);

        return view('admin.property_status')->with(['adminPropertyStatusList'=>$propertyStatusList, 'module'=>'property_status']);
    }
}
