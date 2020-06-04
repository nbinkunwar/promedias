<?php


namespace ProfessorOops\Promedias\Facade;


use Illuminate\Support\Facades\Facade;

class Attachments extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'attachments';
    }
}
