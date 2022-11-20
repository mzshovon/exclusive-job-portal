<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/admin/login', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware'=>['auth']],function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/comments/view', 'HomeController@comments_view')->name('comments-view');
    Route::post('/comments/create', 'HomeController@comments_store')->name('comments-store');
    Route::get('/question_comments/view/{question_id}', 'HomeController@question_comments_view')->name('question-comments-view');
    Route::post('/seen_unseen_comment', 'HomeController@seen_unseen_comment')->name('seen-unseen-comments-view');

    Route::group(['middleware' => 'role:creator|superadmin|admin'], function(){
        // --------------- Role routes ---------------------- //
        Route::get('/role/view', 'Admin\RoleController@view')->name('role-view');
        Route::any('/role/create', 'Admin\RoleController@store')->name('role-create');
        Route::any('/role/update/{id}', 'Admin\RoleController@update')->name('role-update');
        Route::post('/role/delete/{id}', 'Admin\RoleController@delete')->name('role-delete');
        Route::get('/role/permissions/{id}', 'Admin\RoleController@permissions_by_role')->name('role-permission');

        // --------------- Permission routes ---------------------- //
        Route::get('/permission/view', 'Admin\PermissionController@view')->name('permission-view');
        Route::any('/permission/create', 'Admin\PermissionController@store')->name('permission-create');
        Route::any('/permission/update/{id}', 'Admin\PermissionController@update')->name('permission-update');
        Route::post('/permission/delete', 'Admin\PermissionController@delete')->name('permission-delete');

        // --------------- System and App User routes ---------------------- //
        Route::get('/user/view', 'Admin\UserController@view')->name('user-view');
        Route::get('/app-user/view', 'Admin\UserController@app_user_view')->name('app-user-view');
        Route::any('/user/create', 'Admin\UserController@store')->name('user-create');
        Route::any('/user/update/{id}', 'Admin\UserController@update')->name('user-update');
        Route::post('/user/status/change', 'Admin\UserController@change_status')->name('user-status-change');
    });
    Route::group(['middleware' => 'role:creator|superadmin|admin|writer|data_entry'], function(){
        // --------------- Faq routes ---------------------- //
        Route::get('/faq/view', 'Admin\FaqController@view')->name('faq-view');
        Route::any('/faq/create', 'Admin\FaqController@store')->name('faq-create');
        Route::any('/faq/update/{id}', 'Admin\FaqController@update')->name('faq-update');
        Route::post('/faq/delete', 'Admin\FaqController@delete')->name('faq-delete');

        // --------------- About routes ---------------------- //
        Route::get('/about/view', 'Admin\AboutController@view')->name('about-view');
        Route::any('/about/create', 'Admin\AboutController@store')->name('about-create');
        Route::any('/about/update/{id}', 'Admin\AboutController@update')->name('about-update');
        Route::post('/about/delete', 'Admin\AboutController@delete')->name('about-delete');

        // --------------- Package routes ---------------------- //
        Route::get('/package/view', 'Admin\PackageController@view')->name('package-view');
        Route::any('/package/create', 'Admin\PackageController@store')->name('package-create');
        Route::any('/package/update/{id}', 'Admin\PackageController@update')->name('package-update');
        Route::post('/package/status/change', 'Admin\PackageController@change_status')->name('package-status-change');

        // --------------- Section routes ---------------------- //
        Route::get('/section/view', 'Admin\SectionController@view')->name('section-view');
        Route::any('/section/create', 'Admin\SectionController@store')->name('section-create');
        Route::any('/section/update/{id}', 'Admin\SectionController@update')->name('section-update');
        Route::post('/section/status/change', 'Admin\SectionController@change_status')->name('section-status-change');

        // --------------- Model routes ---------------------- //
        Route::get('/model/view', 'Admin\ModelController@view')->name('model-view');
        Route::any('/model/create', 'Admin\ModelController@store')->name('model-create');
        Route::any('/model/update/{id}', 'Admin\ModelController@update')->name('model-update');
        Route::post('/model/status/change', 'Admin\ModelController@change_status')->name('model-status-change');

        // --------------- Subject routes ---------------------- //
        Route::get('/subject/view', 'Admin\SubjectController@view')->name('subject-view');
        Route::any('/subject/create', 'Admin\SubjectController@store')->name('subject-create');
        Route::any('/subject/question_create/{subject_id}', 'Admin\SubjectController@subject_question_store')->name('subject-question-create');
        Route::any('/subject/question_update/{subject_id}', 'Admin\SubjectController@subject_question_update')->name('subject-question-update');
        Route::any('/subject/update/{id}', 'Admin\SubjectController@update')->name('subject-update');
        Route::post('/subject/status/change', 'Admin\SubjectController@change_status')->name('subject-status-change');

        // --------------- Exam routes ---------------------- //
        Route::get('/exam/view', 'Admin\ExamController@view')->name('exam-view');
        Route::any('/exam/create', 'Admin\ExamController@store')->name('exam-create');
        Route::any('/exam/question_create/{exam_id}', 'Admin\ExamController@exam_question_store')->name('exam-question-create');
        Route::any('/exam/question_update/{exam_id}', 'Admin\ExamController@exam_question_update')->name('exam-question-update');
        Route::any('/exam/update/{id}', 'Admin\ExamController@update')->name('exam-update');
        Route::post('/exam/status/change', 'Admin\ExamController@change_status')->name('exam-status-change');
        Route::get('/exam/subject/questions', 'Admin\ExamController@getQuestions')->name('exam-subject-questions');

        // --------------- Video routes ---------------------- //
        Route::get('/video/view', 'Admin\VideoController@view')->name('video-view');
        Route::any('/video/create', 'Admin\VideoController@store')->name('video-create');
        Route::any('/video/update/{id}', 'Admin\VideoController@update')->name('video-update');
        Route::post('/video/status/change', 'Admin\VideoController@change_status')->name('video-status-change');

        // --------------- Video routes ---------------------- //
        Route::get('/profile/view', 'Admin\UserController@profile')->name('profile-view');
        Route::any('/profile/update/{id}', 'Admin\UserController@update_profile')->name('profile-update');
        Route::post('/profile/status/change', 'Admin\UserController@change_status')->name('profile-status-change');

        // --------------- Excel export/import routes ---------------------- //
        Route::get('/excel/export/{name}/{id}', 'Admin\ExcelController@export_question_answer_excel')->name('excel-question-answer-export');
        Route::get('/excel/export/subject', 'Admin\ExcelController@export_subject_excel')->name('excel-subject-export');
        Route::get('/excel/export/exam', 'Admin\ExcelController@export_exam_excel')->name('excel-exam-export');
        Route::get('/excel/export/user', 'Admin\ExcelController@export_user_excel')->name('excel-user-export');
        Route::post('/subject/question_create_from_excel/{upload_type}/{id}', 'Admin\ExcelController@question_store_from_excel')->name('excel-question-create');

        // --------------- Notification routes ---------------------- //
        Route::get('/notification/push/view', 'Admin\NotificationController@view_push_notification')->name('view-push-notification');
        Route::any('/notification/push/create', 'Admin\NotificationController@store_push_notification')->name('create-push-notification');
        Route::any('/notification/push/update/{id}', 'Admin\NotificationController@update_push_notification')->name('update-push-notification');
        Route::post('/notification/push/status', 'Admin\NotificationController@change_push_notification_status')->name('change-push-notification-status');
        Route::post('/notification/push/send', 'Admin\NotificationController@send_push_notification')->name('send-push-notification');
        Route::get('/notification/sms/view', 'Admin\NotificationController@view_sms_notification')->name('view-sms-notification');
        Route::any('/notification/sms/create', 'Admin\NotificationController@store_sms_notification')->name('create-sms-notification');
        Route::any('/notification/sms/update/{id}', 'Admin\NotificationController@update_sms_notification')->name('update-sms-notification');
        Route::post('/notification/sms/status', 'Admin\NotificationController@change_sms_notification_status')->name('change-sms-notification-status');
        Route::post('/notification/sms/send', 'Admin\NotificationController@send_sms_notification')->name('send-sms-notification');
    });
    // --------------- Error routes ---------------------- //
    Route::get('/401', 'ErrorViewPageController@unauthorized')->name('unauthorized');

});

