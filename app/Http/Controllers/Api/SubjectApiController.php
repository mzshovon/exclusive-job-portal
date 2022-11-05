<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsAnswersResultRequest;
use App\Http\Services\ApiSubjectService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectApiController extends Controller
{
    use ApiResponser;

    public function __construct(private ApiSubjectService $apiSubjectService){}

    public function getSubjects() : JsonResponse
    {
        try{
            $data = $this->apiSubjectService->getSubjectsInfo();
            $message = "Subjects data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getQuestionsAndOptionsSubjectId($subjectId) : JsonResponse
    {
        try{
            $data = $this->apiSubjectService->getQuestionsWithOptionsInfo($subjectId);
            $message = "Subject Questions data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTotalScoreBySubject(StoreQuestionsAnswersResultRequest $request) : JsonResponse
    {
        try{
            $data = $this->apiSubjectService->getScoreInfo($request);
            $message = "Result data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
