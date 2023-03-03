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

    /**
     * @OA\Get(
     *      path="/api/subjects/",
     *      summary="Get subject details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Subject"},
     *      description="Returns subject information",
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

    /**
     * @OA\Get(
     *      path="/api/subjects/questions/{subjectId}",
     *      summary="Get subjects details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Subject"},
     *      description="Returns subjects's questions information",
     *      @OA\Parameter(
     *         name="subjectId",
     *         in="path",
     *         description="Subject unique ID",
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

    /**
     * @OA\Get(
     *      path="/api/subjects/chapters/{subjectId}",
     *      summary="Get chapters details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Subject"},
     *      description="Returns chapter's questions information",
     *      @OA\Parameter(
     *         name="subjectId",
     *         in="path",
     *         description="Subject unique ID",
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
    public function getChapterBySubjectId($subjectId) : JsonResponse
    {
        try{
            $data = $this->apiSubjectService->getChapterInfo($subjectId);
            $message = "Subject Questions data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/subjects/chapters/questions/{chapterId}",
     *      summary="Get chapters questions details",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Subject"},
     *      description="Returns chapter's questions information",
     *      @OA\Parameter(
     *         name="chapterId",
     *         in="path",
     *         description="Chapter unique ID",
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
    public function getQuestionsAndOptionsChapterId($subjectId) : JsonResponse
    {
        try{
            $data = $this->apiSubjectService->getChapterQuestionsWithOptionsInfo($subjectId);
            $message = "Subject Questions data";
            return $this->success($data, $message);
        }
        catch(Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/subjects/questions-answers/score",
     *      summary="Store subject score",
     *      security={ {"bearerAuth": {} }},
     *      tags={"Subject"},
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
