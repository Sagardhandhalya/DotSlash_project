<?php

use Illuminate\Http\Request;

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

//  School
Route::apiresource('/school', 'API\SchoolController');
Route::post('adddepartment', 'API\SchoolController@createDepartment');
Route::get('getdepartments', 'API\SchoolController@getDepartments');
Route::get('getusers', 'API\SchoolController@users');
Route::get('department-teacher/{department}', 'API\SchoolController@getTeachersByDepartment');
Route::get('analysis/{school}', 'API\SchoolController@numberData');

//  User
Route::apiresource('/user', 'API\UserController');
Route::get('teacher-courses/{user}', 'API\UserController@teacherCourses');
Route::get('student-courses', 'API\UserController@studentCourses');
Route::post('changepassword', 'API\UserController@changePassword');

//  Class
Route::apiresource('myclass', 'API\MyclassController');
Route::get('/getsections/{id}', 'API\MyclassController@section');

//  Section
Route::apiresource('section', 'API\SectionController');
Route::get('getcourses/{section}', 'API\SectionController@sectionCourses');
Route::get('getstudents/{section}', 'API\SectionController@sectionStudents');


// Course
Route::apiresource('course', 'API\CourseController');
Route::post('/uploadmaterial/{course}', 'API\CourseController@upLoadMaterial');