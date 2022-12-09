<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\WardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AdminController::class,'admin']);

Route::post('/login',[AdminController::class, 'login']);

Route::get('/logout', [AdminController::class,'logout']);

Route::get('/homeadmin',[AdminController::class,'homeadmin']);
Route::get('/allComment',[AdminController::class,'all_comment']);
Route::delete('/delete-comment/{id}',[AdminController::class,'delete_comment']);
Route::get('/allReplyComment',[AdminController::class,'all_reply_comment']);
Route::delete('/delete-replycomment/{id}',[AdminController::class,'delete_replycomment']);
Route::resource('course',CourseController::class);

Route::get('/api/fetch-major',[FacultyController::class, 'fetchMajor'] );
Route::resource('faculty',FacultyController::class);

Route::resource('major',MajorController::class);

Route::resource('category',CategoryController::class);


Route::get('/api/fetch-ward',[DistrictController::class, 'fetchWard'] );
Route::resource('district', DistrictController::class);

Route::resource('ward', WardController::class);

Route::prefix('student')->group(function () {
    Route::get('signup',[StudentController::class,'signup']);
    Route::post('post-signup',[StudentController::class,'post_signup']);
    Route::get('forget-password',[StudentController::class,'update_password']);
    Route::post('save-password',[StudentController::class,'save_password']);
    Route::get('home', [StudentController::class,'home']);
    Route::get('logout', [StudentController::class,'logout']);
    Route::get('profile/{id}',[StudentController::class,'profile']);
    Route::get('update-avatar/{id}',[StudentController::class,'update_avatar']);
    Route::post('save-avatar/{id}',[StudentController::class,'save_avatar']);
    Route::get('update-profile/{id}',[StudentController::class,'update_profile']);
    Route::post('save-profile/{id}',[StudentController::class,'save_profile']);
    Route::get('all-post', [StudentController::class,'all_post']);
    Route::get('create-post', [StudentController::class,'create_post']);
    Route::post('save-post', [StudentController::class,'save_post']);
    Route::get('category/{id}',[StudentController::class,'show_post_category']);
    Route::get('{id}/edit-post/{post_id}',[StudentController::class,'student_edit_post']);
    Route::post('{id}/update-post/{post_id}',[StudentController::class,'student_update_post']);
    Route::get('detail-post/{id}',[StudentController::class,'detail_post']);
    Route::post('post/{id}/comment',[StudentController::class,'student_comment']);
    Route::get('detail-post/{id}/edit-comment/{comment_id}',[StudentController::class,'student_edit_comment']);
    Route::post('detail-post/{id}/update-comment/{comment_id}',[StudentController::class,'student_update_comment']);
    Route::get('detail-post/{id}/delete-comment/{comment_id}',[StudentController::class,'student_delete_comment']);
    Route::post('confirm/{id}',[StudentController::class,'confirm']);
    Route::get('detail-post/{id}/reply-comment/{comment_id}',[StudentController::class,'reply_comment']);
    Route::post('post/{id}/reply-comment/{comment_id}',[StudentController::class,'save_reply_comment']);
    Route::get('detail-post/{id}/edit-replycomment/{replycomment_id}',[StudentController::class,'student_edit_replycomment']);
    Route::post('detail-post/{id}/update-replycomment/{replycomment_id}',[StudentController::class,'student_update_replycomment']);
    Route::get('detail-post/{id}/delete-replycomment/{replycomment_id}',[StudentController::class,'student_delete_replycomment']);
    Route::get('category/{id}',[StudentController::class,'show_post_category']);
    Route::post('search',[StudentController::class,'search']);
    Route::get('district/{id}',[StudentController::class,'search_via_district']);
    Route::get('confirmed/{id}',[StudentController::class,'student_confirmed']);
    Route::post('add-rating/{id}',[StudentController::class,'add_rating']);
    Route::get('history/{id}',[StudentController::class,'history']);
    Route::get('report/{id}',[StudentController::class,'student_report']);
    Route::get('major/{id}',[StudentController::class,'search_via_major']);
    Route::post('follow/{id}',[StudentController::class,'follow']);
    Route::post('unfollow/{id}',[StudentController::class,'unfollow']);
    Route::get('list-follow/{id}',[StudentController::class,'list_follow']);
    Route::get('history-confirm/{id}',[StudentController::class,'history_confirm']);
    Route::post('agree/{id}',[StudentController::class,'agree']);
    Route::post('disagree/{id}',[StudentController::class,'disagree']);
    Route::post('cancelconfirm/{id}',[StudentController::class,'cancel_confirm']);
});


Route::resource('student',StudentController::class);

Route::get('post/{id}/list',[PostController::class,'list_report']);
Route::post('post/search-time',[PostController::class,'search_time']);
Route::resource('post',PostController::class);

