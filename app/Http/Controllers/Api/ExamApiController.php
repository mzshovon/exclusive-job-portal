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

    /**
     * @OA\Get(
     *      path="/api/exams/",
     *      summary="Get exams details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Exam"},
     *      description="Returns exam information",
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

    /**
     * @OA\Get(
     *      path="/api/exams/questions/{examId}",
     *      summary="Get exams details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Exam"},
     *      description="Returns exam's questions information",
     *      @OA\Parameter(
     *         name="examId",
     *         in="path",
     *         description="Exam unique ID",
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

    /**
     * @OA\Post(
     *     path="/api/exams/questions-answers/score",
     *      summary="Store exam score",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Exam"},
     *      description="Returns score number",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"parentId", "questions[]", "answers[]"},
     *               @OA\Property(property="parentId", type="int"),
     *               @OA\Property(property="questions[]",
     *                      description="Questions ID",
     *                      type="array",
     *                     collectionFormat="multi",
     *                @OA\Items(type="int", format="id"),
     *           ),
     *               @OA\Property(property="answers[]",
     *                      description="Answers ID",
     *                      type="array",
     *                     collectionFormat="multi",
     *                @OA\Items(type="int", format="id"),
     *           ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login Successful",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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
