<?php
/**
 * Created by PhpStorm.
 * User: nbin
 * Date: 6/25/18
 * Time: 1:22 PM
 */

namespace ProfessorOops\Promedias\Traits;



use ProfessorOops\Promedias\Attachment;

trait AttachableTrait
{

    /**
     * @return mixed
     */
    public function defaultAttachments()
    {
        return $this->morphMany(Attachment::class,'attachable')->where('media_type','default');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachable');
    }

    /**
     * @return |null
     */
    public function getFirstImage()
    {
        if($this->attachments->count()>0)
        {
            return $this->attachments[0]->media->file_name;
        }
        return null;
    }

    /**
     * @param $field
     * @return |null
     */
    public function getImage($field)
    {
        $relation = camel_case($field);
        if($this->{$relation}){
            return $this->{$relation}->media->file_name;
        }
        return null;
    }

    /**
     * @return |null
     */
    public function getCoverImage()
    {
        if($this->coverImage)
        {
            return $this->coverImage->media->file_name;
        }
        return null;
    }
}
