<?php

namespace ProfessorOops\Promedias;


use Intervention\Image\Facades\Image;

class MediaJobs{

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $file;
    private $width;
    private $height;
    public function __construct($file,$width = '', $height = '')
    {
        $this->file = $file;
        $this->width = $width;
        $this->height = $height;
    }

    public static function validationRules()
    {
        return [
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    /**
     * @param Media $media
     * @param Attachment $attachment
     * @return bool
     */
    public function upload()
    {
        $image = $this->file;
        if(!$image)
        {
            return false;
        }
        $original_name = $image->getClientOriginalName();
        $imageName = time().'.'.str_replace(' ','-',$original_name);
        $destinationPath = storage_path().'/uploads/original';
        $resizedPath = storage_path().'/uploads/resized/'.$imageName;
        if(!file_exists($destinationPath))
        {
            mkdir($destinationPath,0755,true);
        }

        if(!file_exists($resizedPath))
        {
            mkdir($resizedPath,0755,true);
        }
        if($this->width && $this->height)
        {
            Image::make($image->getRealPath())->fit($this->width,$this->height)->save($resizedPath);
        }
        if($image->move($destinationPath, $imageName))
        {
            $media = new Media();
            $media->fill(['file_name'=>$imageName,'original_name'=>$original_name])->save();
            return $media;
//            return $attachment->fillAndSave(['media_id'=>$result->id,'attachable_id'=>null,'attachable_type'=>null]);
        }
        return false;
    }
}
