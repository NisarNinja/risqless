<?php

use App\Http\Controllers\HomeController;
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

Route::get('test',function(){
     echo "workring";
});
Route::group(['namespace'=>'App\Http\Controllers\Api'], function()
{

    Route::group(['prefix' =>'auth'], function () {
        Route::post('signup',  'AuthController@process_signup');
        Route::post('login',  'AuthController@login');
        Route::post('facebook-login','AuthController@loginWithFacebook');
        Route::post('google-login','AuthController@googleLogin');
        Route::post('apple-login','AuthController@appleLogin');
    });
    
    Route::group(['prefix' =>'file'], function () {
        Route::get('test',  'FileUploadController@index');
        Route::post('upload',  'FileUploadController@dropzoneFileUpload');
    });

    Route::get('notifications','NotificationController@index');

    Route::post('trial/activate','AuthController@activateTrial');

    Route::get('in-app-purchase-status','InAppPurchaseController@statusUpdate');
});

// Route::get('file',[HomeController::class,'fileAPI']);