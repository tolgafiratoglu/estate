<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PropertyRepository;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PropertyRepository $propertyRepository)
    {

        $latestProperties = $propertyRepository->getPropertyList(false, true, false, 0, 4, 'id', 'DESC');

        return view('home', ["latestProperties"=>$latestProperties]);
    }
}
