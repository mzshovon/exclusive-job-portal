<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsAnswersResultRequest;
use App\Http\Services\ApiExamService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamApiController extends Controller
{
    use ApiResponser;

    public function __construct(private ApiExamService $apiExamService){}

    public function getExams(Request $request) : JsonResponse
    {
        try{
            $examType = $request->get('examType') ?? null;
            $data = $this->apiExamService->getExamsInfo($examType);
            $message = "Exams data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getQuestionsAndOptionsExamId($examId) : JsonResponse
    {
        try{
            $data = $this->apiExamService->getQuestionsWithOptionsInfo($examId);
            $message = "Exam Questions data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTotalScoreByExam(StoreQuestionsAnswersResultRequest $request) : JsonResponse
    {
        try{
            $data = $this->apiExamService->getScoreInfo($request);
            $message = "Result data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
