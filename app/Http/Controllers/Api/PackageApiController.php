<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiPackageService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageApiController extends Controller
{
    use ApiResponser;

    public function __construct(private ApiPackageService $apiPackageService){}

    /**
     * @OA\Get(
     *      path="/api/packages/",
     *      summary="Get package details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Package"},
     *      description="Returns package information",
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
    public function getPackages() : JsonResponse
    {
        try{
            $data = $this->apiPackageService->getPackagesInfo();
            $message = "Packages data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/packages/courses/{packageId}",
     *      summary="Get packages course details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Package"},
     *      description="Returns packages's courses information",
     *      @OA\Parameter(
     *         name="packageId",
     *         in="path",
     *         description="Package unique ID",
     *         required=false,
     *         @OA\Schema(type="int")
     *      ),
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
    public function getCoursesByPackages($packageId) : JsonResponse
    {
        try{
            $data = $this->apiPackageService->getCoursesInfo($packageId);
            $message = "Courses By Package";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/packages/sections/{packageId}",
     *      summary="Get packages section details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Package"},
     *      description="Returns packages's sections information",
     *      @OA\Parameter(
     *         name="packageId",
     *         in="path",
     *         description="Package unique ID",
     *         required=false,
     *         @OA\Schema(type="int")
     *      ),
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
    public function getSectionsByPackages($packageId) : JsonResponse
    {
        try{
            $data = $this->apiPackageService->getSectionsInfo($packageId);
            $message = "Sections By Package";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getSubjectsByCourses($courseId) : JsonResponse
    {
        try{
            $data = $this->apiPackageService->getSubjectsByCourseIdInfo($courseId);
            $message = "Subjects By Course";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
