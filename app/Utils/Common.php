<?php


namespace App\Utils;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait Common
{
    public  function multipleFileUpload($files, $path)
    {
        $filePathName = [];
        foreach ($files as $file) {
            $originName = $file->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $file->storeAs($path, $fileName);
            Storage::put($path . '/' . $fileName, file_get_contents($file));
            $filePathName[] =  $path . "/" . $fileName;

        }
        return $filePathName;
    }
    public  function fileUpload($file, $path,$imageSizes=[])
    {

        $originalFile=$file;
        $currentTimeStamp=time();
        $originName = $file->getClientOriginalName();
        $actualFileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $actualFileName . '_' .$currentTimeStamp . '.' . $extension;

        $file->storeAs($path, $fileName);
        Storage::put($path . '/' . $fileName, file_get_contents($file));

        foreach ($imageSizes as $imageSize) {
            $originalFileFit = Image::make($originalFile->getRealpath())->fit($imageSize->width, $imageSize->height);
            $originalFileFit->orientate();
            $originalFileFit->encode($extension);
            Storage::put($path . '/' . $actualFileName ."_".$currentTimeStamp. "_".$imageSize->width."*".$imageSize->height."." . $extension, $originalFileFit);
        }

        $filePathName =  $path . "/" . $fileName;
        return $filePathName;
    }

    public function fileUrl($path){
        return Storage::url($path);
    }
    public function fileDelete($file){
        Storage::delete($file);

    }

    public function getShopId(){
        $currentUser = Auth::user();
        return $currentUser->hasRole('Vendor') ? $currentUser->shop->id :($currentUser->hasRole('Vendor Manager')?$currentUser->manager->shop_id: "");
    }


}
