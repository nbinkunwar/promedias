<?php


namespace ProfessorOops\Promedias\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use ProfessorOops\Promedias\Facade\Attachments;
use ProfessorOops\Promedias\MediaJobs;
use ProfessorOops\Promedias\Resources\MediaResource;
use ProfessorOops\Support\Traits\ApiResponse;

/**
 * @group Media Management
 * Class MediaController
 * @package ProfessorOops\Promedias\Http\Controllers
 */
class MediaController extends Controller
{

    use ApiResponse;

    /**
     * @bodyParam image image required
     * @apiResource ProfessorOops\Promedias\Resources\MediaResource
     * @apiResourceModel ProfessorOops\Promedias\Media
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,MediaJobs::validationRules());
        if($request->hasFile('image')){
            $media = new MediaJobs($request->file('image'));
            $uploaded = $media->upload();
            return $this->respondSuccess(new MediaResource($uploaded));
        }
        return $this->respondError(['image'=>'image field is required']);

    }


    /**
     * @urlParam path string required
     * @response imageFile
     * @param Filesystem $filesystem
     * @param Request $request
     * @param $path
     * @return mixed
     */
    public function view(Filesystem $filesystem,Request $request,$path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);
//        try{
//            ImageOptimizer::optimize(storage_path('../public/uploads/original/'.$path));
//        }catch (\Exception $e)
//        {
////            print_r($e->getMessage());
//            //handle exception
//        }

//        $base64 = $server->getImageAsBase64($path,$request->all());
//        return $base64;
        $response = $server->getImageResponse($path, $request->all());
        return $response;
    }

}
