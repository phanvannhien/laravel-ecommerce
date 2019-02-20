<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Models
 */

use App\Models\UserMedia;

/**
 * Facades
 */

 use Auth;


class MediaController extends Controller{
    public function upload(Request $request)
    {
        dd( Auth::user() );
        if($request->hasFile('file'))
        {
            $validation = $request->validate([
                'file' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
                // for multiple file uploads
                // 'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            ]);
            $file      = $validation['file']; // get the validated file
            $extension = $file->getClientOriginalExtension();
            $filename  = md5( microtime() )  . $extension;
            $path      = $file->storeAs('photos', $filename);
                
            $image = new UserMedia();
            $image->name = $filename;
            $image->type = $file->getMimeType();
            $image->extension = $extension;
            $image->user_id = Auth::id();
            $image->save();

            return response()->json(['success' => 'You have successfully uploaded an image'], 200);

        }

 

       
    }

 
}