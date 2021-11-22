<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::any('/admin_dashboard',function(){
    return view('admin.dashboard');
});

Route::group(['namespace' => 'Web'], function () {
    Auth::routes(['register'=>true, 'reset'=>false]);


    Route::post('registerUser','Auth\RegisterController@register')->name('registerUser');
    Route::post('register\teacher','Auth\RegisterController@teacher')->name('register.teacher');
    Route::post('register\sponsor','Auth\RegisterController@sponsor')->name('register.sponsor');

    Route::group(['middleware' => 'auth' ], function () {

        Route::resource('/charities','CharityController')->except('destroy');
        Route::get('charities/{classroom}/destroy', 'CharityController@destroy')->name('charities.delete');
        Route::post('charities/list', 'CharityController@getList')->name('charities.getList');
        Route::get('charities-dropdown-list', 'CharityController@getCharity')->name('charities.get-charity');
        Route::get('charities-donate','CharityController@donateCharities')->name('leaderboard.donate');
        Route::POST('charity/{id}/donate','CharityController@donateCharity')->name('leaderboard.donate.charity');

        Route::resource('/subjects','SubjectController')->except('destroy');
        Route::post('subjects/list', 'SubjectController@getList')->name('subjects.getList');
        Route::get('subjects/{subject}/destroy', 'SubjectController@destroy')->name('subjects.delete');
        Route::get('subjects-dropdown-list', 'SubjectController@getSubject')->name('subjects.get-subject');
        Route::post('subjects/teacher/list', 'SubjectController@getTeacherSubjectList')->name('subjects .teacher.getList');
        Route::get('subjects-teacher', 'SubjectController@teacherSubjects')->name('subjects.teacher.index');

        Route::resource('/goals','GoalController')->except('destroy');
        Route::get('goals/{goal}/destroy', 'GoalController@destroy')->name('goals.delete');
        Route::post('goals/list', 'GoalController@getList')->name('goals.getList');

        Route::resource('/classrooms','ClassroomController')->except('destroy');
        Route::get('classrooms/{classroom}/destroy', 'ClassroomController@destroy')->name('classrooms.delete');
        Route::post('classrooms/list', 'ClassroomController@getList')->name('classrooms.getList');
        Route::post('classrooms/teacher/list', 'ClassroomController@getTeacherClassroomList')->name('classrooms.teacher.getList');
        Route::get('classrooms-dropdown-list', 'ClassroomController@getClassroom')->name('classrooms.get-classroom');
        Route::get('classrooms-teacher', 'ClassroomController@teacherClassroom')->name('classrooms.teacher.index');

        Route::resource('users','UserController')->except('destroy');
        Route::get('usersList', 'UserController@getList')->name('users.getList');
        Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');

        Route::get('users-dropdown-list', 'UserController@getUser')->name('users.get-user');
        Route::get('teachers-dropdown-list', 'UserController@getTeacher')->name('users.get-teacher');


        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('dashboard/list', 'DashboardController@getList')->name('dashboard.getList');

        Route::get('changePassword','ProfileController@showChangePasswordForm');
        Route::post('changePassword','ProfileController@changePassword')->name('changePassword');

        Route::get('teacher-profile','ProfileController@showTeacherProfileForm');
        Route::post('teacher-profile','ProfileController@teacherProfile')->name('teacher.profile');

        Route::get('profile','ProfileController@showProfileForm');
        Route::post('profile','ProfileController@profile')->name('profile');

        Route::resource('permission','PermissionController');
        Route::get('permission-dropdown-list', 'PermissionController@getPermission')->name('permission.get-permission');
        Route::get('permission-list', 'PermissionController@getList')->name('permission.get-list');

        Route::resource('role','RoleController');
        Route::get('role-list', 'RoleController@getList')->name('role.get-list');
        Route::get('role-dropdown-list', 'RoleController@getRole')->name('role.get-role');

        Route::get('leaderboard','LeaderBoardController@index')->name('leaderboard');
        Route::get('leaderboard/{id}','LeaderBoardController@show')->name('leaderboard.show');
        Route::POST('leaderboard-list','LeaderBoardController@getList')->name('leaderboard.getList');


        Route::get('donation','DonationController@index')->name('donations.index');
        Route::post('donation-list','DonationController@getList')->name('donations.getList');



    });

});

Route::get('terms_conditions', 'Web\PageController@terms_conditions')->where('any', '.*');
Route::get('{any}', 'Web\PageController@home')->where('any', '.*');
