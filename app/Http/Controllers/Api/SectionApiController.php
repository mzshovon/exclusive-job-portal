<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiSectionService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SectionApiController extends Controller
{
    use ApiResponser;

    public function getSections(ApiSectionService $apiSectionService) : JsonResponse
    {
        try{
            $data = $apiSectionService->getSectionsInfo();
            $message = "Section data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
