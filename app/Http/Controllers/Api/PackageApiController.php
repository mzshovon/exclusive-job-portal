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
