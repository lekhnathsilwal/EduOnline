<?php

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
    return view('welcome');
});
Route::get('/student_index', function () {
    return view('student.pages.index');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/log', 'PagesController@login');
Route::get('/reg', 'PagesController@register');
Route::get('/teacher-request', 'Admin\TeacherHandler@showRequest')->name('admin.teacher-request');
Route::get('/teachers-list', 'Admin\TeacherHandler@showTeachers')->name('admin.teachers-list');
Route::get('/students-list', 'Admin\StudentHandler@showStudents')->name('admin.students-list');
Route::get('admin/teacher-profile/{id}', 'Admin\TeacherHandler@showTeacherProfile');
Route::get('admin/student-profile/{id}', 'Admin\StudentHandler@showStudentProfile');
Route::get('admin/student-delete/{id}', 'Admin\StudentHandler@deleteStudent');
Route::get('admin/site', 'Admin\SiteController@index');
Route::resource('slide', 'Admin\SlideController');
Route::resource('circle_news', 'Admin\CircleNewsController');
Route::resource('square_news', 'Admin\SquareNewsController');
Route::get('edit-student-profile/{id}', 'Student\PagesController@editProfile');
Route::POST('update-student-profile/{id}', 'Student\PagesController@updateProfile');
Route::get('admin/teacher-confirm/{id}', 'Admin\TeacherHandler@confirmTeacher');
Route::get('admin/teacher-delete/{id}', 'Admin\TeacherHandler@deleteTeacher');
Route::get('admin/post-delete/{id}', 'Admin\TeacherHandler@deletePosts');
Route::get('teacher-profile/{id}', 'Auth\TeacherController@showProfile')->middleware('verified');
Route::get('edit-profile/{id}', 'Auth\TeacherController@editProfile')->middleware('verified');
Route::POST('search-teacher', 'Auth\TeacherController@search');
Route::get('change-teacher-password/{id}', 'Auth\TeacherController@changePassword')->middleware('verified');
Route::POST('update-teacher-password/{id}', 'Auth\TeacherController@updatePassword');
Route::POST('update-profile', 'Auth\TeacherController@updateProfile');
Route::get('student/student-profile/{id}', 'Student\PagesController@showProfile');
Route::get('show-teacher-profile/{id}', 'Student\HomeController@showTeacherProfile');
Route::get('student/change-password/{id}', 'Student\PagesController@changePassword');
Route::POST('student/update-password/{id}', 'Student\PagesController@updatePassword');
Route::POST('student/search-teacher', 'Student\PagesController@search');
Route::resource('posts','Auth\PostController')->middleware('verified');
Route::get('/deleteFile/{id}', 'Auth\PostController@deleteFile')->middleware('verified');
Route::post('comments/{post_id}/{user_type}', ['uses' => 'CommentsController@store', 'as' =>'comments.store']);
Route::post('comments/{comment_id}', ['uses' => 'CommentsController@update', 'as' =>'comments.update']);
Route::get('comment/edit/{comment_id}','CommentsController@edit');
Route::get('comment/delete/{comment_id}','CommentsController@destroy');
Route::POST('admin/search-teacher', 'Admin\TeacherHandler@searchTeacher');
Route::POST('admin/search-student', 'Admin\StudentHandler@searchStudent');
Route::get('/likes/{post_id}','CommentsController@likes');
Route::get('/unlikes/{post_id}','CommentsController@unlikes');
Route::get('/teacher_likes/{post_id}','CommentsController@teacher_likes');
Route::get('/teacher_unlikes/{post_id}','CommentsController@teacher_unlikes');
Route::get('admin/view-all-files/{post_id}', 'Admin\TeacherHandler@viewAllFiles');
Route::get('student/view-all-files/{post_id}', 'Student\HomeController@viewAllFiles');
Route::get('view-all-files/{post_id}', 'Auth\TeacherController@viewAllFiles')->middleware('verified');
Route::get('admin/most-liked-posts', 'Admin\TeacherHandler@mostLikedPosts');
Route::get('admin/payment-request', 'Admin\TeacherHandler@showPaymentRequest');
Route::get('payment_request', 'Auth\PaymentController@payment_form')->middleware('verified');
Route::get('admin/clear_payment/{payment_id}', 'Admin\TeacherHandler@pay');
Route::post('payment_store/{user_id}', ['uses' => 'Auth\PaymentController@payment_store', 'as' =>'payment.store']);
Route::get('change_email', function (){
    return view('auth.changeEmail');
});
Route::get('change_student_email', function () {
    return view('student.auth.changeStudentEmail');
});
Route::get('/verifyStudent', function () {
    return view('student.verify');
});
Route::get('/confirmVerification/{user_id}', 'Student\PagesController@confirmVerification');
Route::get('/resend_verification', 'Student\PagesController@resendVerification');
Route::post('changeStudentEmail', ['uses' => 'Student\PagesController@changeStudentEmail', 'as' =>'changeStudentEmail']);