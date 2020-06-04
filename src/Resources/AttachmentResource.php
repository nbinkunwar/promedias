<?php


namespace ProfessorOops\Promedias\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'media_id'=>$this->media_id,
            'file_name'=>optional($this->media)->file_name,
            'media_type'=>$this->media_type,
            'caption'=>$this->caption,
            'created_at'=>$this->created_at
        ];
    }
}
