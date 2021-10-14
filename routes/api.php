<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('pin', 'AuthController@pin');
        Route::put('2fa', 'AuthController@verify2fa');
        Route::post('biometric', 'AuthController@biometric');
    });

    // Forgot Password Apis 
    Route::get('forgot-password', 'AuthController@forgot_password');
    Route::post('check-reset-code', 'AuthController@checkResetCode');
    Route::post('reset-password', 'AuthController@resetPassword');


    // After Login 
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('user', 'AuthController@user');
            Route::put('changePassword', 'AuthController@changePassword');
            Route::post('logout', 'AuthController@logout');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::put('updateProfile', 'UserController@updateProfile');
            Route::put('updateAvatar', 'UserController@updateAvatar');
            Route::put('enablePin', 'UserController@updatePin');
            Route::put('enableBiometric', 'UserController@updateBiometric');
            Route::put('enable2fa', 'UserController@update2FA');
            Route::put('verify2fa', 'UserController@verify2FA');
        });

        Route::resource('notification', 'NotificationController');

    });

    // Without Auth

});
