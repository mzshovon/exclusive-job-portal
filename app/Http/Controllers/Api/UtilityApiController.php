<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiUtilityService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UtilityApiController extends Controller
{
    use ApiResponser;

    public function __construct(private ApiUtilityService $apiUtilityService){}

    public function getFaqs() : JsonResponse
    {
        try{
            $data = $this->apiUtilityService->getFaqsInfo();
            $message = "F.A.Q data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAbouts(Request $request) : JsonResponse
    {
        try{
            $aboutType = $request->get('type') ?? null;
            $data = $this->apiUtilityService->getAboutsInfo($aboutType);
            $message = "About data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getVideos(Request $request) : JsonResponse
    {
        try{
            $data = $this->apiUtilityService->getVideosInfo();
            $message = "Video data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
