<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use App\Repositories\MediaRepository;

use Intervention\Image\ImageManagerStatic as Image;

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
    
    public function resizeAndCrop($width, $height, $publicPathForFile)
    {
        
        $imageSourceToCrop = Image::make($publicPathForFile);
        $imageWidth = $imageSourceToCrop->width();
        $imageHeight = $imageSourceToCrop->height(); 

        if($imageWidth/$imageHeight >=$width/$height){
            $imageNewWidth = $imageWidth*($height/$imageHeight);
            $imageSourceToCrop->resize($imageNewWidth, $height);
            $offsetX = intval(($imageSourceToCrop->width() - $width)/2);
            $offsetY = 0;
        }else{
            $imageNewHeight = $imageHeight*($width/$imageWidth);
            $imageSourceToCrop->resize($width, $imageNewHeight);
            $offsetY = intval(($imageSourceToCrop->height() - $height)/2);
            $offsetX = 0;
        }
            $imageSourceToCrop->crop($width, $height, $offsetX, $offsetY);
                $imageSourceToCrop->save($publicPathForFile);
        
    }

    /**
     * Save new media. This method is under auth middleware.
     *
     * @return \Symfony\Component\HttpFoundation\Response 
     */
    public function save(Request $request, MediaRepository $mediaRepository)
    {
        
        $response = [];
        
        $validatedData = $this->validate($request, ['image_to_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000000',]);

        $fileToUpload = $validatedData["image_to_upload"];

        if($fileToUpload->isValid()) {

            $currentMonth = date('n');
            $currentYear  = date('Y');

            // Storage path:
            $storagePath = storage_path();
            

            // Subfolder to save in /year/month/file format:
            $imageFolder = DIRECTORY_SEPARATOR.$currentYear.DIRECTORY_SEPARATOR.$currentMonth;

            // Get file related meta data:
            $fileName = str_replace(" ", "", $fileToUpload->getClientOriginalName());
            $fileMimeType = $fileToUpload->getClientMimeType();

            $userId = Auth::user()->id;

            $fileName = $userId."_".uniqid()."_".$fileName;

            // Original image:
            Storage::disk('public')->put($imageFolder.DIRECTORY_SEPARATOR.$fileName, file_get_contents($fileToUpload));
            // Large image:
            Storage::disk('public')->put($imageFolder.DIRECTORY_SEPARATOR."large".DIRECTORY_SEPARATOR.$fileName, file_get_contents($fileToUpload));
            // Thumb:
            Storage::disk('public')->put($imageFolder.DIRECTORY_SEPARATOR."thumb".DIRECTORY_SEPARATOR.$fileName, file_get_contents($fileToUpload));

            // Resize and crop large:
            $this->resizeAndCrop(400, 266, $storagePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.$imageFolder.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$fileName);

            // Resize and crop thumb:
            $this->resizeAndCrop(1200, 742, $storagePath.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.$imageFolder.DIRECTORY_SEPARATOR.'large'.DIRECTORY_SEPARATOR.$fileName);


            $fileFolder = 'storage/'.$currentYear.'/'.$currentMonth.'/';

            $media = $mediaRepository->create(["name"=>$fileName, "folder"=>$fileFolder, "user_id"=>$userId, "media_type"=>$fileMimeType]);

            $imagePath = asset($fileFolder.'/thumb/'.$media['name']);

            $response = ["id"=>$media->id, "image_path"=>$imagePath];

        }    

        return response()->json($response);

    }

}
