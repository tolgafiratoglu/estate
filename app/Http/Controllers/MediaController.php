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
        
        $validatedData = $this->validate($request, ['image_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000000',]);

        $fileToUpload = $validatedData["image_to_upload"];

        if($fileToUpload->isValid()) {

            $currentMonth = date('n');
            $currentYear  = date('Y');

            $storagePath = storage_path();

            // Subfolder to save in /year/month/file format:
            $imageFolder = DIRECTORY_SEPARATOR.$currentYear.DIRECTORY_SEPARATOR.$currentMonth;

            // Get file related meta data:
            $fileName = $file->getClientOriginalName();
            $fileMimeType = $file->getClientMimeType();
            $fileSize = $file->getSize();

            $userId = Auth::user()->id;

        }    

        return response()->json($response);

    }

}
