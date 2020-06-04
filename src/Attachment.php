<?php
/**
 * Created by PhpStorm.
 * User: nbin
 * Date: 6/25/18
 * Time: 1:19 PM
 */

namespace ProfessorOops\Promedias;


use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{


    protected $fillable = ['media_id','attachable_id','attachable_type','media_type','caption'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }

}
