<?php


namespace ProfessorOops\Promedias\Facade;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use ProfessorOops\Promedias\Attachment;
use ProfessorOops\Promedias\MediaJobs;

class AttachmentHandler
{
    private $attachable;
    private $file;
    private $attachment;

    public function make($file,$attachable)
    {
        $this->attachable = $attachable;
        $this->file = $file;
        return $this;

    }

    public function upload($width = '', $height = '')
    {
        $media = new MediaJobs($this->file,$width,$height);
        $media = $media->upload();
        return $this;
    }

    public function attach()
    {
        return $this->doAttach();
    }

    /**
     * @param Attachment $attachmentInter
     * @return bool
     */
    protected function doAttach()
    {
        if($this->attachment)
        {
            return $this->attachable->attachments()->save($this->attachment);
        }
        return false;
    }

    public function routes()
    {
        require __DIR__.'/../routes.php';
    }

    public function authRoutes()
    {
        require __DIR__.'/../auth-routes.php';
    }

}
