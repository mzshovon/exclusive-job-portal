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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sections','Api\SectionApiController@getSections')->name('api-sections');

Route::get('/packages','Api\PackageApiController@getPackages')->name('api-packages');

Route::get('/subjects','Api\SubjectApiController@getSubjects')->name('api-subjects');

Route::get('/questions/{subjectId}','Api\SubjectApiController@getQuestionsAndOptionsSubjectId')->name('api-questions-options');

Route::get('/packages/courses/{packageId}','Api\PackageApiController@getCoursesByPackages')->name('api-courses-packages');

Route::get('/courses/subjects/{courseId}','Api\PackageApiController@getSubjectsByCourses')->name('api-subjects-courses');
