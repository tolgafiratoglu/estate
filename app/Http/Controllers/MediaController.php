<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
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
     * Save new media. This method is under auth middleware.
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function save(Request $request)
    {
        
        $response = [];

        $file = $request->file("image_to_upload");

        var_dump($file);
        
        $validatedData = $this->validate($request, ['image_to_upload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000000',]);

        var_dump($validatedData);

        return response()->json($response);

    }

}
