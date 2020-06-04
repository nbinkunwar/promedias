<?php


namespace ProfessorOops\Promedias\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'file_name'=>$this->file_name,
            'created_at'=>$this->created_at
        ];
    }

}
