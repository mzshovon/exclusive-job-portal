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

    /**
     * @OA\Get(
     *      path="/api/faqs/",
     *      summary="Get faqs details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Utility"},
     *      description="Returns faq information",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     *     )
     */
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

    /**
     * @OA\Get(
     *      path="/api/abouts/",
     *      summary="Get abouts details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Utility"},
     *      description="Returns about information",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     *     )
     */
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

    /**
     * @OA\Get(
     *      path="/api/videos/",
     *      summary="Get videos details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Utility"},
     *      description="Returns video information",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     *     )
     */
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
