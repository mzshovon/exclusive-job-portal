<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login/otp', 'Api\AuthorizationController@login')->name('api-user-login');
Route::post('/login/password', 'Api\AuthorizationController@login')->name('api-user-login');
Route::post('/verify', 'Api\AuthorizationController@verify')->name('api-user-verify');


Route::get('/sections', 'Api\SectionApiController@getSections')->name('api-sections');

Route::get('/faqs', 'Api\UtilityApiController@getFaqs')->name('api-faqs');

Route::get('/videos', 'Api\UtilityApiController@getVideos')->name('api-videos');

Route::get('/abouts', 'Api\UtilityApiController@getAbouts')->name('api-abouts');

Route::group(['prefix' => 'packages'], function () {
    Route::get('/', 'Api\PackageApiController@getPackages')->name('api-packages');
    Route::get('/courses/{packageId}', 'Api\PackageApiController@getCoursesByPackages')->name('api-courses-packages');
    Route::get('/sections/{packageId}', 'Api\PackageApiController@getSectionsByPackages')->name('api-sections-packages');
    Route::get('/courses/subjects/{courseId}', 'Api\PackageApiController@getSubjectsByCourses')->name('api-subjects-courses');
});

Route::group(['prefix' => 'subjects'], function () {
    Route::get('/', 'Api\SubjectApiController@getSubjects')->name('api-subjects');
    Route::get('/chapters/{subjectId}', 'Api\SubjectApiController@getChapterBySubjectId')->name('api-subject-chapters');
    Route::get('/chapters/questions/{chapterId}', 'Api\SubjectApiController@getQuestionsAndOptionsChapterId')->name('api-chapter-questions');
    Route::get('/questions/{subjectId}', 'Api\SubjectApiController@getQuestionsAndOptionsSubjectId')->name('api-subject-questions-options');
    Route::post('/questions-answers/score', 'Api\SubjectApiController@getTotalScoreBySubject')->name('api-subject-questions-answers-score');
});

Route::group(['prefix' => 'exams'], function () {
    Route::get('/', 'Api\ExamApiController@getExams')->name('api-exams');
    Route::get('/questions/{examId}', 'Api\ExamApiController@getQuestionsAndOptionsExamId')->name('api-exam-questions-options');
    Route::post('/questions-answers/score', 'Api\ExamApiController@getTotalScoreByExam')->name('api-exam-questions-answers-score');
});
