<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait PhotoTrait
{
    public function savePhoto($image){
        $fileName = 'image_'.time().rand(1,999).'.png';
        $path = 'public/' . $fileName;

        if(preg_match('/utf-8/',$image)){
            $image = str_replace('data:image/*;charset=utf-8;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            if (is_array($image)) {
                $image = implode($image);
            }
        }
        else {
            @list(, $image) = explode(';', $image);
            @list(, $image) = explode(',', $image);
        }
        if($image != ""){
           Storage::put($path, base64_decode($image));
        }
        $exists = Storage::exists($path);
        if(!$exists){
            return response()->json(['success' => false, 'message' => 'Failed Saving Picture']);
        }
        return $path;
    }

    public function deletePhoto($name, $path){
        Storage::disk('local')->delete($path.$name);
    }
}